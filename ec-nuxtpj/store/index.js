export const state = () => ({
  cart: [],
})

export const getters = {
  getCart: state => {
    return state.cart;
  },
  getPrice: state => {
    return state.cart.map(e => e.product.price * e.quantity);
  },
}

export const mutations = {
  putInCart(state, payload) {
    const checkItem = state.cart.some(e => e.product.id == payload.product.id);
    console.log(checkItem);
    if (checkItem) {
      alert("この商品はすでにカートに入っています");
    }else{
      state.cart.push(payload);
      console.log(state.cart);
    }
  },
  clearItem(state) {
    state.cart = [];
  },
  changeQuantity(state, payload) {
    const currentItem = state.cart.find(e => e.product.id == payload.item_id);
    console.log(currentItem);
    currentItem.quantity = payload.quantity;
  },
  putOutItem(state, payload) {
    const index = state.cart.findIndex(e => e.product.id == payload);
    state.cart.splice(index, 1);
  }
}
