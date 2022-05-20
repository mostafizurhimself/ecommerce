<template>
	<div>
		<!-- search -->
		<div class="flex flex-col md:flex-row justify-between md:items-center mb-4">
			<div>
				<slot name="search"></slot>
			</div>

			<!-- Filter -->
			<div class="flex justify-between mt-4 md:mt-0">
				<!-- Action Dropdown -->
				<action-dropdown v-if="!disableCheck" :align="hasFilterSlot || hasButtonSlot ? 'left': 'right'" :class="{'mr-4': hasFilterSlot || hasButtonSlot}">
					<div>
						<slot v-if="checkedList.length" :ids="checkedList" :getData="getResults" name="bulk-action">
							<div class="text-sm tracking-wide text-center">No action available</div>
						</slot>
						<div v-else class="text-sm tracking-wide text-center">No items selected</div>
					</div>
				</action-dropdown>

				<!-- Filter Dropdown -->
				<filter-dropdown :align="hasButtonSlot ? 'left': 'right'" v-if="hasFilterSlot" :class="{'mr-4': hasButtonSlot}">
					<div class="px-1 py-2">
						<slot name="filter"></slot>
					</div>
				</filter-dropdown>

				<!-- Slot for resource create button -->
				<slot name="button"></slot>

			</div>
		</div>
		<div class="bg-white rounded-primary overflow-hidden">
			<loader :loading="isLoading">
				<div class="overflow-x-auto" v-if="laravelData.data && laravelData.data.length">
					<table>
						<thead>
							<tr>
								<th v-if="!disableCheck">
									<form-checkbox tiny v-model="allSelected" @change="handleAllSelect"></form-checkbox>
								</th>
								<th v-if="showIndex">#</th>
								<th v-for="(col, index) in availableColumns" :key="index">
									<div class="flex items-center">
										<span class="mr-2">{{getLabel(col)}}</span>
										<!-- Sort Icon -->
										<!-- <span class="sort" role="button" @click="handleSort(col)" v-if="col.sortable !== false">
											<i class="ti-angle-up" :class="{ active: sort.key == getField(col) && sort.order == 'asc',}"></i>
											<i class="ti-angle-down" :class="{ active: sort.key == getField(col) && sort.order == 'desc',}"></i>
										</span> -->
									</div>
								</th>
								<th class="text-right" v-if="hasActionSlot"></th>
							</tr>
						</thead>
						<tbody>
							<template v-for="(row, index) in laravelData.data">
								<slot name='table-rows' :row="row" :index="index" :availableColumns="availableColumns" :getField="getField" :getLabel="getLabel" :remove="remove">
									<tr :key="index">
										<td v-if="!disableCheck">
											<form-checkbox tiny v-model="checkedList" :value="row.id" @change="onDataCheck"></form-checkbox>
										</td>
										<td v-if="showIndex">{{ index + 1 }}</td>
										<td class="truncate" style="max-width:200px" v-for="(col, index) in availableColumns" :key="index" :title="getLabel(col)">
											<slot :name="getField(col)" :col="row[getField(col)]" :row="row">
												{{ getFieldOutput(row, col) }}
											</slot>
										</td>
										<td align="right" v-if="hasActionSlot">
											<!-- Action Column Slot -->
											<div class="flex justify-end items-center">
												<slot name="action" :row="row" :remove="remove" :index="index" v-if="row.deletedAt == null">
												</slot>
												<div v-else>
													<!-- Restore -->
													<button title="Restore" class="btn btn-success" @click="restore(row.id, index)">
														<i class="ti-reload"></i>
													</button>
													<!-- Force Delete -->
													<button title="Force Delete" class="btn btn-danger" @click="forceDelete(row.id, index)">
														<i class="ti-eraser"></i>
													</button>
												</div>
											</div>
										</td>
									</tr>
								</slot>
							</template>
						</tbody>
					</table>
				</div>

				<div class="flex justify-center items-center text-gray-600 h-32" v-else>
					<span>
						<slot name="nodata">
							<span class="text-sm tracking-widest">No Data Found</span>
						</slot>
					</span>
				</div>
			</loader>
		</div>

		<!-- Large screen Pagination -->
		<div class="flex flex-col sm:flex-row justify-between items-center mt-6 invisible md:visible" v-if="laravelData.data && laravelData.data.length">
			<div class="text-gray-600 text-sm mb-4 sm:mb-0">Showing {{laravelData.meta.from}}-{{laravelData.meta.to}} of {{laravelData.total}} data</div>
			<!-- Table Pagination -->
			<pagination :limit="3" :data="laravelData" @pagination-change-page="getResults"></pagination>
		</div>

		<!-- Small Screen pagination -->
		<div class="flex flex-col sm:flex-row justify-between items-center mt-6 visible md:invisible" v-if="laravelData.data && laravelData.data.length">
			<div class="text-gray-600 text-sm mb-4 sm:mb-0">Showing {{laravelData.meta.from}}-{{laravelData.meta.to}} of {{laravelData.total}} data</div>
			<!-- Table Pagination -->
			<pagination :limit="-1" :data="laravelData" @pagination-change-page="getResults"></pagination>
		</div>
	</div>
</template>

<script>
import debounce from "lodash/debounce";
export default {
	props: {
		/**
		 * Available columns name
		 */
		columns: {
			type: Array,
			required: true,
		},

		/**
		 * Api url to get data
		 */
		url: {
			type: String,
			required: true,
		},

		/**
		 * Filters for the datatable
		 */
		filters: {
			type: [Object, Array],
			default: {},
		},

		/**
		 * Enable softdelete methods
		 */
		softDelete: {
			type: Boolean,
			default: true,
		},

		/**
		 * Show the row number
		 */
		showIndex: {
			type: Boolean,
			default: false,
		},

		/**
		 * Disable Checkbox
		 */
		disableCheck: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			isLoading: false,
			laravelData: {},
			checkedList: [],
			sort: {
				key: "id",
				order: "desc",
			},
			showFilter: false,
			showDeleteDrop: false,
			allSelected: false,
		};
	},

	computed: {
		/**
		 * Get the available columns for render
		 */
		availableColumns() {
			return this.columns.filter((item) => {
				if (typeof item === "object") {
					if (item.hasOwnProperty("permission")) {
						return item.permission;
					}
				}
				return item;
			});
		},

		/**
		 * Get the actionable ids
		 */
		actionable() {
			const rows = this.laravelData.data.filter((row) => {
				return (
					this.checkedList.includes(row.id) && row.deletedAt === null
				);
			});

			return rows.map((row) => row.id);
		},

		/**
		 * Get the restoreable ids
		 */
		restorable() {
			const rows = this.laravelData.data.filter((row) => {
				return (
					this.checkedList.includes(row.id) && row.deletedAt !== null
				);
			});

			return rows.map((row) => row.id);
		},

		/**
		 * Check the table has action slot
		 */
		hasActionSlot() {
			return !!this.$scopedSlots["action"];
		},

		/**
		 * Check the table has bulk action slot
		 */
		hasBulkActionSlot() {
			return !!this.$scopedSlots["bulk-action"];
		},

		/**
		 * Check the table has filter slot
		 */
		hasFilterSlot() {
			return !!this.$slots["filter"];
		},

		/**
		 * Check the table has button slot
		 */
		hasButtonSlot() {
			return !!this.$slots["button"];
		},
	},

	watch: {
		/**
		 * Watch for search value changes
		 */
		filters: {
			handler: debounce(function () {
				this.getResults();
			}, 500),
			deep: true,
		},

		/**
		 * Watch for checkedList value changes
		 */
		checkedList(value) {
			this.$emit("onCheck", value);
		},
	},

	methods: {
		/**
		 * A function to take a string written in dot notation style, and use it to
		 * find a nested object property inside of an object.
		 *
		 * @param String nested A dot notation style parameter reference (ie "urls.small")
		 * @param Object object (optional) The object to search
		 *
		 * @return the value of the property in question
		 */

		getProperty(o, s) {
			s = s.replace(/\[(\w+)\]/g, ".$1"); // convert indexes to properties
			s = s.replace(/^\./, ""); // strip a leading dot
			var a = s.split(".");
			for (var i = 0, n = a.length; i < n; ++i) {
				var k = a[i];
				if (k in o) {
					o = o[k];
				} else {
					return;
				}
			}
			return o;
		},

		/**
		 * Get the Field Output
		 */
		getFieldOutput(row, col) {
			return this.getProperty(row, this.getField(col)) ?? "-";
		},

		/**
		 * Get the column label
		 */
		getLabel(value) {
			if (typeof value === "object") {
				return value.label || value.field;
			}
			return value;
		},

		/**
		 * Get the column field name
		 */
		getField(value) {
			if (typeof value === "object") {
				return value.field;
			}
			return value;
		},

		/**
		 * Get the query string from filter
		 */
		getQueries(filters) {
			let queryString = "";
			for (const key in filters) {
				queryString += `&${key}=${filters[key]}`;
			}

			return queryString;
		},

		sortString() {
			return `${this.sort.key},${this.sort.order}`;
		},

		/**
		 * Get the result from laravel endpoint
		 */
		getResults(page = 1) {
			// Set the loading
			this.isLoading = true;
			this.$axios
				.get(
					`${this.url}?page=${page}${this.getQueries(
						this.filters
					)}&sort=${this.sortString()}`
				)
				.then((response) => {
					// Set data
					this.laravelData = response.data;
					// Disable loading
					this.isLoading = false;

					this.allSelected = false;
					this.checkedList = [];
				})
				.catch((err) => {
					console.log(err);
					this.allSelected = false;
					this.checkedList = [];
					// Disable loading
					this.isLoading = false;
				});
		},

		/**
		 * Handle data sorting
		 */
		handleSort(column) {
			const key = this.getField(column);

			if (key === this.sort.key) {
				this.sort.order = this.sort.order === "asc" ? "desc" : "asc";
			} else {
				this.sort.order = "asc";
			}

			// Set the sort key
			this.sort.key = key;

			// Get the data
			this.getResults();
		},

		/**
		 * Handle All Select
		 */
		handleAllSelect(e) {
			if (this.allSelected)
				this.checkedList = this.laravelData.data.map((data) => data.id);
			else this.checkedList = [];
		},
		/**
		 * When Check on Single Data Checkbox
		 */
		onDataCheck() {
			// Toggle All Select Checkbox
			if (this.checkedList.length === this.laravelData.data.length)
				this.allSelected = true;
			else this.allSelected = false;
		},

		/**
		 * Delete items from list
		 */
		remove(id, index) {
			this.$swal
				.fire({
					title: "Are you sure want to delete?",
					icon: "warning",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, delete it!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							await this.$axios.delete(`${this.url}/` + id);

							// this.laravelData.data.splice(index, 1);
							this.getResults();
							this.$toast.success("Deleted successfully");
						} catch (error) {
							this.$toast.error("Delete Failed!");
							console.log(error);
						}
					}
				});
		},

		/**
		 * Delete all selected resources
		 */
		removeAll() {
			this.$swal
				.fire({
					title: "Are you sure want to delete?",
					icon: "warning",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, delete all!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							await this.$axios.post(`${this.url}/delete-all`, {
								ids: this.deletable,
							});

							this.getResults();
							this.$toast.success("Deleted successfully");
						} catch (error) {
							this.$toast.error("Delete Failed!");
							console.log(error);
						}
					}
				});
		},

		/**
		 * Restore the resource
		 */
		restore(id, index) {
			this.$swal
				.fire({
					title: "Are you sure want to restore?",
					icon: "info",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, restore it!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							const res = await this.$axios.post(
								`${this.url}/${id}/restore`
							);
							// this.laravelData.data.splice(
							// 	index,
							// 	1,
							// 	res.data.data
							// );
							this.getResults();
							this.$toast.success("Restored successfully");
						} catch (error) {
							this.$toast.error("Restore failed");
							console.log(error);
						}
					}
				});
		},

		/**
		 * Restore all selected resources
		 */
		restoreAll() {
			this.$swal
				.fire({
					title: "Are you sure want to restore all?",
					icon: "info",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, restore all!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							await this.$axios.post(`${this.url}/restore-all`, {
								ids: this.restorable,
							});

							this.getResults();
							this.$toast.success("Restored successfully");
						} catch (error) {
							this.$toast.error("Restore Failed!");
							console.log(error);
						}
					}
				});
		},

		/**
		 * Force delete the resource
		 */
		forceDelete(id, index) {
			this.$swal
				.fire({
					title: "Are you sure?",
					text: "You won't be able to revert this!",
					icon: "warning",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, delete it!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							await this.$axios.delete(
								`${this.url}/${id}/force-delete`
							);

							this.laravelData.data.splice(index, 1);
							this.$toast.success("Deleted successfully");
						} catch (error) {
							this.$toast.error("Delete Fail!");
							console.log(error);
						}
					}
				});
		},

		/**
		 * Force delete all the selected resources
		 */
		forceDeleteAll() {
			this.$swal
				.fire({
					title: "Are you sure?",
					text: "You won't be able to revert this!",
					icon: "warning",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, delete all!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							await this.$axios.post(
								`${this.url}/force-delete-all`,
								{
									ids: this.checkedList,
								}
							);

							this.getResults();
							this.$toast.success("Deleted successfully");
						} catch (error) {
							this.$toast.error("Delete Failed!");
							console.log(error);
						}
					}
				});
		},
	},

	created() {
		// Listening to global event.
		this.$nuxt.$on("getResults", () => {
			this.getResults();
		});

		/**
		 * Fetch the initial result
		 */
		this.getResults();
	},
};
</script>

<style lang="scss">
.sort {
	@apply flex items-center flex-col;
	i {
		@apply text-gray-400 text-sm;
		line-height: 10px;
		font-size: 10px;
	}

	i.active {
		@apply text-gray-900;
	}
}
</style>
