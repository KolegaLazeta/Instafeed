<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg focus" role="document">
      <div class="modal-content gradient-custom3">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>

        </div>
        <h1 class="text-white text-center mt-2 mb-0">
          Search for all users
        </h1>
        <div class="modal-body">
          <div class="d-flex justify-content-center px-4">
            <div class="search">
              <input type="text" v-model="name" autofocus class="search-input" placeholder="Search..." name=""/>
              <a class="search-icon text-white">
                <i class="fa fa-search"></i>
              </a>
            </div>
          </div>
          <div class="row d-flex justify-content-center mt-3 p-3">
              <div class="col-lg-12" v-if="name">
            <div v-if="list.Products.length" class="rounded bg-white w-100 mb-1"> 
                
           
            <div v-if="users"
              class="rounded bg-white w-100 mb-1"> <div class="w-100 p-1 rounded text-center text-white bg-blue">
              </div>
            <a v-for="value in list.Clients"
              :key="value.id" class="bg-white p-2 w-100 d-flex justify-content-between link-unstyled text-decoration-none w-100" :href="'#'+user_id">
             
              </a>
            </div>
            </div>
          </div>
            <div class="row p-3 mb-5">
            <div class="col-4 p-1 col-lg-2 mr-0">
              <div class="inner p-3 d-flex flex-column align-items-center">
                <img src="/storage/images/Mb8kaPV.png" width="50" />
                <div class="text-center">
                  <span class="text-darker font-weight-300 h5">Account</span>
                </div>
              </div>
            </div>
            
            

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "",
  data: function () {
    return {
      name: "",
      messag: "",
      list: [],
    };
  },
  methods: {
    async getData(input) {
      await this.showData(input);
    },
    showData(value) {
      const options = {
        method: "GET",
        url: "/apiProducts/q",
        params: { value },
      };
      axios
        .request(options)
        .then((response) => {
          this.list = response.data;
        })
        .catch(function (error) {
          console.error(error);
        });
    },
  },
  watch: {
    name: function (value) {
        this.getData(value);
        if(value == ""){
        this.list = [];
        }
    },
  }
};
</script>
