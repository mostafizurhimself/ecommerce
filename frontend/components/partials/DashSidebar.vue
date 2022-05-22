<template>
    <div class="dash-sidebar-root" :class="rootSidebarClasses">
        <!-- Header Slot -->
        <slot name="header">
            <div class="">
                <div :class="{'lg:hidden' : collapsed}" class="text-center border-b pb-4 mb-2">
                    <h2 class="text-2xl">DashSidebar</h2>
                    <p>Admin Dashboard</p>
                </div>
            </div>
        </slot>

        <!-- Menu list wrapper -->
        <!-- Menu List -->
        <div v-for="(menu, i) in menuList" :key="i" class="menu-list">
            <!-- menu list item -->
            <div @click="getMenuLink(menu, i)" class="list-item" :class="{active: menu.active}">
                <!-- Title and Icon -->
                <div :class="{'lg:mx-auto' : collapsed}">
                    <i :class="menu.icon" class="p-1"></i>
                    <span :class="{'lg:hidden' : collapsed}">{{ menu.title }}</span>
                </div>

                <!-- + -  Toggle Icon -->
                <div v-if="menu.hasOwnProperty('children')" class="text-sm" :class="{'lg:hidden' : collapsed}">
                    <i v-if="!menu.showChildren" class="ti-plus p-2"></i>
                    <i v-else class="ti-minus p-2"></i>
                </div>
            </div>

            <!-- Submenu -->
            <div v-if="menu.showChildren" class="pl-6" :class="{'lg:hidden' : collapsed}">
                <!-- submenu item -->
                <div v-for="(child, i) in menu.children" :key="i" class="submenu-list">
                    <div @click="getMenuLink(child, i)" class="sub-list-item" :class="{active: child.active}">
                        {{ child.title }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'dash-sidebar',
    data() {
        return {
            menuList: [],
            key: 0
        }
    },

    computed: {
        rootSidebarClasses() {
            return `${this.rootClass} ${this.rootPadding} ${this.bgColor} ${this.collapsed ? 'collapsed' : ''}`
        }
    },
    methods: {
        getMenuLink(menu, i) {
            if (menu.hasOwnProperty('children')) {
                this.menuList = this.menuList.map((m, ii) => ({
                    ...m,
                    showChildren: i == ii ? !m.showChildren : false
                }))

                return
            }

            this.$router.push(menu.href)
        },
        setMenuList() {
            this.menuList = this.list.map(menu => ({
                showChildren: false,
                ...menu,
            }))

            this.setActiveRoute()
        },

        setActiveRoute() {
            const route = this.$route
            const isRouteActive = (menu) => menu.hasOwnProperty('activeRoutes') ? menu.activeRoutes.includes(route.name) : false

            this.menuList = this.menuList.map(menu => ({
                ...menu,
                showChildren: isRouteActive(menu),
                active: isRouteActive(menu),
                ...(menu.hasOwnProperty('children') ? {
                    children: menu.children.map(child => ({
                        ...child,
                        active: isRouteActive(child),
                    }))
                } : {})
            }))
        }

    },
    created() {
        this.setMenuList()
    },
    watch: {
        $route(to, from) {
            this.setActiveRoute()
        }
    },
    props: {
        // list of Menu item
        list: {
            type: Array,
            required: true
        },
        // Root Class
        rootClass: {
            type: String,
            default: ''
        },
        // Wrapper Padding
        rootPadding: {
            type: String,
            default: 'p-3'
        },
        // Wrapper Background Color
        bgColor: {
            type: String,
            default: 'bg-white'
        },
        // Width
        width: {
            type: String,
            default: '280px'
        },
        // Collpased
        collapsed: {
            type: Boolean,
            required: true,
        }
    },
}
</script>

<style lang="scss" scoped>
.dash-sidebar-root {
    @apply h-screen overflow-hidden w-72 flex-shrink-0 absolute lg:relative transition lg:transition-none duration-500 ease-in-out z-20;

    // if sidebar collapsed
    &.collapsed {
        @apply transform -translate-x-full lg:translate-x-0 lg:w-20;
    }

    // Menu List item
    .menu-list {
        .list-item {
            @apply cursor-pointer py-2 my-1 hover:text-purple-700 flex justify-between font-medium;
            &.active {
                @apply text-purple-700;
            }
        }
    }

    // Submenu list item
    .submenu-list {
        .sub-list-item {
            @apply cursor-pointer py-2 my-1 hover:text-purple-700 flex justify-between;
            &.active {
                @apply text-purple-700;
            }
        }
    }
}
</style>