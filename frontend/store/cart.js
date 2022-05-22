// states
export const state = () => ({
  cart: [],
  totalDiscount: 0
});

// getters
export const getters = {
  getCartItems(state) {
    return state.cart;
  },

  getTotalItem(state) {
    if (state.cart.length > 99) {
      return '99+';
    } else {
      return state.cart.length;
    }
  },

  getTotalPrice(state) {
    let total = 0;
    state.cart.forEach(item => {
      total += item.price * item.quantity;
    });
    return total;
  },

  getTotalDiscount(state) {
    return state.totalDiscount
  },

  getGrandTotal(state, getters) {
    return getters.getTotalPrice - state.totalDiscount;
  },

};

// mutations
export const mutations = {
  ADD_TO_CART(state, item) {
    let selectedItem = state.cart.find(product => product.id == item.id);
    if (selectedItem) {
      selectedItem.quantity++
      this.$toast.success('Quantity updated');
    } else {
      state.cart.push({
        ...item,
        quantity: 1
      });
      this.$toast.success('Item added');
    }
  },

  SAVE_DATA(state) {
    localStorage.setItem("cart", JSON.stringify(state.cart));
  },

  SET_CART(state) {
    state.cart = localStorage.getItem('cart') ?
      JSON.parse(localStorage.getItem('cart')) : [];
  },

  CART_ITEM_QUANTITY(state, payload) {
    // console.log(payload.item.name, payload.val);
    let selectedItem = state.cart.find(product => product.id == payload.item.id);
    selectedItem.quantity = payload.val
    // console.log(selectedItem.quantity);
  },

  REMOVE_FROM_CART(state, item) {
    let index = state.cart.indexOf(item);
    state.cart.splice(index, 1);
  },

  RESET_CART(state) {
    localStorage.setItem('cart', []);
    state.cart = []
  }

};

// actions
export const actions = {
  addToCart(context, payload) {
    context.commit('ADD_TO_CART', payload);
    context.commit('SAVE_DATA', payload);
  },

  removeFromCart(context, payload) {
    context.commit('REMOVE_FROM_CART', payload);
    context.commit('SAVE_DATA', payload);
  },

  setCart(context) {
    context.commit('SET_CART');
  },

  resetCart(context) {
    context.commit('RESET_CART');
  }

};
