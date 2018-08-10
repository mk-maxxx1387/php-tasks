let app = new Vue({
    el: "#app",
    data: {
        products: [
        	{
        		id: 1,
        		name: "Tld .com",
        		price: "10.00"
        	},
        	{
        		id: 2,
        		name: "Tld .net",
        		price: "10.00"
        	},
        	{
        		id: 3,
        		name: "Tld .org",
        		price: "10.00"
        	},
        	{
        		id: 4,
        		name: "Tld .cafe",
        		price: "10.99"
        	},
        	{
        		id: 5,
        		name: "Tld .club",
        		price: "10.87"
        	},
        	{
        		id: 6,
        		name: "Tld .biz",
        		price: "10.00"
        	}

        ],
        cart: [] 
    },
    computed: {
        cartTotalPrice: function(){
            let price = 0;
            this.cart.forEach(function(product){
                price+=parseFloat(product.price);
            });
            return price.toFixed(2);
        }
    },
    mounted(){
    	if (localStorage.getItem('cart')) {
    		try{
    			console.log(1);
    			this.cart = JSON.parse(localStorage.getItem('cart'));
    		} catch(e) {
        		localStorage.removeItem('cart');
      		}
    	}
    },
    methods: {
    	addToCart: function(index){
    		console.log
    		this.cart.push(this.products[index]);
    		this.saveCart();
    	},
    	removeFromCart: function(index){
    		this.cart.splice(index, 1);
    		this.saveCart();
    	},
    	saveCart: function(){
    		let jsonCart = JSON.stringify(this.cart);
    		localStorage.setItem('cart', jsonCart);
    	}
    }
})