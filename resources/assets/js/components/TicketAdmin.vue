<template lang="html">
    <form class="mb-5 col-md-12" @submit.prevent="submit">
        <transition name="fade">
            <div class="alert info" :class="messageClass" role="alert" v-show="msg.show">
                <i class="fa fa-info-circle"></i> {{msg.message}}
            </div>
        </transition>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" v-model="name">

            <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                <ul class="m-0">
                    <li v-for="error in errors.getError('name')">{{error}}</li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Beschreibung</label>
            <input type="text" name="description" id="description" class="form-control" v-model="description">

            <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('description')">
                <ul class="m-0">
                    <li v-for="error in errors.getError('description')">{{error}}</li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label for="">Autor</label>
            <multiselect
              v-model="author"
              :options="options"
              :custom-label="customLabel"
              track-by="id"
              placeholder="Autor"
              :allow-empty="false"
              >
            </multiselect>

            <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('author')">
                <ul class="m-0">
                    <li v-for="error in errors.getError('author')">{{error}}</li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label for="">Nutzer</label>
            <multiselect
              v-model="selectedUser"
              :options="options"
              :custom-label="customLabel"
              :multiple="true"
              track-by="id"
              placeholder="Nutzer"
              :allow-empty="false"
              >
            </multiselect>
        </div>
        <button type="submit" class="form-control btn btn-success"><i class="fa fa-plus"></i> Hinzufügen</button>
    </form>
</template>

<script>
import Multiselect from 'vue-multiselect';

class Errors{
    constructor(){
        this.errors = {};
    }

    setErrors(errors){
        this.errors = errors
    }

    clearErrors(){
        this.errors = {}
    }

    getError(name){
        return this.errors[name];
    }

    hasError(name){
        if(this.errors.hasOwnProperty(name)){
            return this.errors[name];
        }
        return null;
    }
}

class Message {
    constructor(){
        this.show = false;
        this.type = "success";
        this.message = "";
    }

    showMessage(msg, type = "success"){
        this.message = msg;
        this.type = type;
        this.show = true;
        setTimeout(() => {
            this.show = false;
        }, 2000);
    }
}

export default {
    components: { Multiselect },
    props: ['users'],
    data () {
        return {
            name: "",
            description: "",
            selectedUser: null,
            author: null,
            options: this.users,
            errors: new Errors(),
            msg: new Message(),
        }
    },
    methods: {
        customLabel (options) {
            return `${options.name}`
        },
        submit(){
            // if(this.author === null){
            //     this.errors.setErrors({author: "Das Ticket muss einen Author besitzen."})
            // }
            let vue = this;
            axios.post('/working_tickets/admin', {
                name: vue.name,
                description: vue.description,
                author: vue.author,
                users: vue.selectedUser
            }).then(function(response){
                //console.log(response);
                vue.errors.clearErrors();
                vue.name = null;
                vue.description = null;
                vue.selectedUser = null;
                vue.author = null;
                vue.msg.showMessage(response.data.message, "success");
            }).catch(function(errors){
                vue.errors.setErrors(errors.response.data.errors);
                //console.log(errors.response.data.errors);
            });
        }
    },
    computed: {
        messageClass: function(){
            return 'alert-' + this.msg.type;
        },
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="css" scoped>
    .info{
        position: absolute;
        top: 5px;
        right: 0;
        z-index: 50;
    }

    .fade-enter-active, .fade-leave-active{
        transition: opacity 0.2s ease-out;
    }
    .fade-enter, .fade-leave-to{
        opacity: 0;
    }
</style>
