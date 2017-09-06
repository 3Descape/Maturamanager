<template>
    <div>

        <div v-show="!edit_state" class="description_wrp">
            <p v-html="ticket.description"></p>
            <button class="btn-warning btn description_button" @click="edit">
                <i class="fa fa-edit"></i>
            </button>
        </div>

        <div class="mb-2" v-show="edit_state">
            <form class="" action="" method="post">
                <textarea name="name" rows="8" cols="80" class="form-control mr-2" v-model="ticket.description"></textarea>
                <button type="submit" class="btn btn-warning form-control" @click.prevent="update">
                    <i class="fa fa-edit"></i> Bearbeiten
                </button>
            </form>
        </div>

        <transition name="fade">
            <div class="alert alert-success info" role="alert" v-show="msg">
                <i class="fa fa-info-circle"></i> Bearbeitet
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['ticketProp'],
        data: function(){
            return {
                ticket: this.ticketProp,
                edit_state: false,
                msg: false,
            }
        },
        methods: {
            edit: function(){

                this.edit_state = !this.edit_state;
                this.ticket.description = this.ticket.description.replace(new RegExp('<br />', 'g'), '\r\n');
            },
            update: function(){
                var vue = this;
                vue.edit_state = !vue.edit_state;
                this.ticket.description = this.ticket.description.replace(new RegExp('\r?\n','g'), '<br />');

                axios.post('/working_tickets/'+ vue.ticket.id +'/update_description', {
                    description: vue.ticket.description,
                    _method: "PUT"
                })
                .then(function (response) {
                    vue.msg = true;
                    setTimeout(function(){
                        vue.msg = false;
                    }, 2000);
                })
                .catch(function (errors) {
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
.description_wrp{
    position: relative;
}

.description_button{
    position: absolute;
    opacity: 0.3;
    top: 5px;
    right: 5px;
    transition: opacity 0.2s ease-in-out;
}
.description_button:hover{
    opacity: 1;
}
.info{
    position: absolute;
    top: 5px;
    right: 0;
    opacity:
}

.fade-enter-active, .fade-leave-active{
    transition: opacity 0.2s ease-out;
}
.fade-enter, .fade-leave-to{
    opacity: 0;
}

</style>
