var app = new Vue({
  el: '#app',
  data: {
    errors: [],
    name: null,
    email: null,
    phone: null,
    password:null,
    role : null
  },
  methods:{
    checkForm: function (e) {
      if (this.name && this.email && this.phone && this.password && this.role) 
      {
        return true;
      }
      this.errors = [];
     if(!this.name) {
        this.errors.push('Name required.');
      }
      if(!this.email) {
        this.errors.push('Email required.');
      }
      if(!this.phone){
        this.errors.push('Phone required');
      }
      if(!this.password){
        this.errors.push('password required');
      }
      if(!this.role){
        this.errors.push('role required');
      }
      e.preventDefault();
    }
  }
});

var loginapp = new Vue({
      el:"#Loginapp",
      data:{
          errors: [],
          email: null,
          password: null,
          role : null
      },
      methods: {
          loginForm: function (e) {
      if (this.email && this.password) 
      {
        return true;
      }
      this.errors = [];
     if(!this.email) {
        this.errors.push('Login email required.');
      }
      if(!this.password) {
        this.errors.push('Login password required.');
      }
     
      e.preventDefault();
    }
  }
});