var app2 = new Vue({
  el:'#cartcount',
  data:{
     cart:''
  },
  methods:{
    getCart(){
      axios.get('/cartcount').then(response => this.cart = response.data);
    }
  },
  mounted(){
    this.getCart();
  }
});
