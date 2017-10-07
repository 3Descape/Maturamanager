<template>
    <div class="col-md-6 col-lg-4 pb-4">
        <div class="card h-100" >
            <div class="card-body">
                <h4 class="card-title d-flex">{{ticket.name}}
                    <div class="ml-auto align-self-start d-flex">
                        <form v-if="isAuthor(authUser)" @submit.prevent="updateStatus">
                            <button type="submit" :class="{'btn btn-success': ticket.completed, 'btn btn-danger': !ticket.completed}">
                                <i :class="{'fa fa-check': ticket.completed, 'fa fa-cog': !ticket.completed}"></i>
                            </button>
                        </form>

                        <div v-else :class="{'btn btn-success': ticket.completed, 'btn btn-danger': !ticket.completed}">
                            <i :class="{'fa fa-check': ticket.completed, 'fa fa-cog': !ticket.completed}"></i>
                        </div>
                    </div>
                </h4>
                <transition name="fade">
                    <div class="alert info" :class="messageClass" role="alert" v-show="msg.show">
                        <i class="fa fa-info-circle"></i> {{msg.message}}
                    </div>
                </transition>

                <div v-show="!edit_state" class="description_wrp">
                    <p v-html="compiledMarkdown"></p>
                    <button class="btn-warning btn description_button" @click="edit">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>

                <div class="mb-2" v-show="edit_state">
                    <fieldset :disabled="updating">
                        <form @submit.prevent="updateDescription">
                            <textarea rows="8" class="form-control mr-2" v-model="ticket.markup"></textarea>
                            <button type="submit" class="btn btn-warning form-control">
                                <i v-if="!updating" class="fa fa-edit"> Bearbeiten</i>
                                <i v-if="updating" class="fa fa-spinner fa-pulse"></i>
                            </button>
                        </form>
                    </fieldset>
                </div>


                <a class="btn btn-primary" data-toggle="collapse" :href="'#users'+ticket.id" aria-expanded="false" aria-controls="users">
                  Personen <i class="fa fa-caret-down"></i>
                </a>

                <div class="collapse" :id="'users'+ticket.id">

                    <form v-if="isAuthor(authUser) && addableUsers.length" @submit.prevent="addUser">
                        <div class="input-group mt-2">
                            <select class="custom-select custom-select-left form-control" v-model="selectedPerson">
                                <option v-for="(user, index) in addableUsers" :value="user.id">{{user.name}}</option>
                            </select>
                            <button type="submit" class="input-group-addon">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </form>

                    <ul class="list-group my-2">
                        <li v-for="user in ticket.users" class="list-group-item d-flex">
                            <a :href="'/profil/'+ user.slug">{{user.name}}</a>

                            <form v-if="isAuthor(authUser)" class="ml-auto"  @submit.prevent="removeUser(user)">
                                <button type="submit" class="btn btn-danger" :disabled="isAuthor(user)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- {{round($ticket->user_worked_time_on_ticket(Auth::user())/60, 2)}} -->
                <p class="text-muted mt-4">Du hast {{ticket.timeCount}} Stunden an diesem Ticket mitgearbeitet.</p>
            </div>

            <div class="card-footer text-muted">
              <a :href="'/profil/'+ticket.author.slug">{{ticket.author.name}}</a>
              <!-- {{$ticket->created_at->diffForHumans()}} -->
            </div>
        </div>
    </div>
</template>

<script>
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
        props: ['ticketProp', 'usersToAddProp', 'authUserProp'],
        data: function(){
            return {
                ticket: this.ticketProp,
                edit_state: false,
                updating: false,
                msg: new Message(),
                addableUsers: this.usersToAddProp,
                authUser: this.authUserProp,
                api: {},
                selectedPerson: ""
            }
        },
        methods: {
            edit: function(){
                this.edit_state = true;
            },
            updateDescription: function(){
                let vue = this;
                vue.updating = true;
                axios.post(this.api.update_description, {
                    markup: vue.ticket.markup,
                    html: vue.compiledMarkdown,
                    _method: "PUT"
                }).then(function (response) {
                    vue.edit_state = false;
                    vue.msg.showMessage(response.data.status);
                })
                .catch(function (errors) {
                    vue.msg.showMessage("Fehler", "danger")
                });
            },
            isAuthor: function(user){
                return user.id === this.ticket.author.id;
            },
            updateStatus: function(){
                this.ticket.completed = !this.ticket.completed
                let vue = this;
                axios.post(this.api.status_update, {
                    completed: vue.ticket.completed,
                    _method: "PUT"
                }).then(function (response) {
                    vue.msg.showMessage(response.data.status)
                })
                .catch(function (errors) {
                    vue.msg.showMessage("Fehler", "danger")
                });
            },
            addUser: function(){
                let vue = this;
                axios.post(this.api.add_user, {
                    user_id: vue.selectedPerson,
                }).then(function(response) {
                    let ids = vue.addableUsers.map(function(item){
                        return item.id;
                    });
                    let id = ids.indexOf(vue.selectedPerson);
                    vue.ticket.users.push(vue.addableUsers[id])
                    vue.addableUsers.splice(id, 1);
                    if(vue.addableUsers.length){
                        vue.selectedPerson = vue.addableUsers[0].id;
                    }else {
                        vue.selectedPerson ="";
                    }

                    vue.msg.showMessage(response.data.status, "success")
                })
                .catch(function (errors) {
                    vue.msg.showMessage("Fehler", "danger");
                });
            },
            removeUser: function(user){
                let vue = this;
                axios.post(this.api.remove_user, {
                    user_id: user.id,
                }).then(function(response) {
                    let ids = vue.ticket.users.map(function(item){
                        return item.id;
                    });
                    let id = ids.indexOf(user.id);
                    vue.addableUsers.push(user);
                    vue.ticket.users.splice(id, 1);
                    vue.msg.showMessage(response.data.status);
                })
                .catch(function (errors) {
                    vue.msg.showMessage("Fehler", "danger");
                });
            }
        },
        computed: {
            compiledMarkdown: function(){
                return Marked(this.ticket.markup);
            },
            messageClass: function(){
                return 'alert-' + this.msg.type;
            }
        },
        created: function(){
            Marked.setOptions({
                gfm: true,
                breaks: true,
                tables: true,
            });

            this.api.status_update = `working_tickets/${this.ticket.id}/status/update`;
            this.api.add_user = `/working_tickets/${this.ticket.id}/add_user`;
            this.api.remove_user = `/working_tickets/${this.ticket.id}/remove_user`;
            this.api.update_description = `/working_tickets/${this.ticket.id}/update_description`;

            this.selectedPerson = this.addableUsers[0].id
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
