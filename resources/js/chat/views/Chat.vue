<template>
    <div class="layout-wrapper d-lg-flex">

        <div class="chat-leftsidebar me-lg-1 ms-lg-0">
            <div class="px-4 pt-4">
                <h4 class="mb-4">Chats</h4>
            </div>

            <div class="px-4 pb-4" dir="ltr">
                <div class="contact-users">
                    <div v-for="(user,index) in users" class="item">
                        <a @click="selectContact(user)" class="user-status-box">
                            <div class="avatar-xs mx-auto d-block chat-user-img online">
                                <img :src="user.profile_photo"
                                     alt="{{user.name}}"
                                     class="img-fluid rounded-circle">
                            </div>

                            <h5 class="font-size-13 text-truncate mt-3 mb-1">{{ user.name }}</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden-xs">
                <h5 class="mb-3 px-3 font-size-16">Recent</h5>

                <div class="chat-message-list px-2" data-simplebar>
                    <ul class="list-unstyled chat-list chat-user-list">
                        <li v-for="(contactUser,index) in contactUsers">
                            <a @click="selectContact(contactUser.user)">
                                <div class="d-flex">
                                    <div class="chat-user-img online align-self-center me-3 ms-0">
                                        <img :src="contactUser.user.profile_photo"
                                             class="rounded-circle avatar-xs" alt="">
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15 mb-1">
                                            {{ contactUser.user.name }}
                                        </h5>
                                        <p class="chat-user-message text-truncate mb-0">
                                            <span v-if="contactUser.unreadMessages>0"
                                                  class="badge badge-primary">{{ contactUser.unreadMessages }}</span>
                                            {{ contactUser.message }}
                                        </p>
                                    </div>
                                    <div class="font-size-11">{{ contactUser.created_at }}</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div v-if="Object.keys(selectedContact).length" class="user-chat w-100 overflow-hidden">
            <div class="d-lg-flex">

                <!-- start chat conversation section -->
                <div class="w-100 overflow-hidden position-relative">
                    <div class="p-3 p-lg-4 border-bottom user-chat-topbar">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-8">
                                <div class="d-flex align-items-center">
                                    <div class="d-block d-lg-none me-2 ms-0">
                                        <a href="javascript: void(0);"
                                           class="user-chat-remove text-muted font-size-16 p-2"><i
                                            class="ri-arrow-left-s-line"></i></a>
                                    </div>
                                    <div class="me-3 ms-0">
                                        <img :src="selectedContact.profile_photo"
                                             class="rounded-circle avatar-xs"
                                             alt="">
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-0 text-truncate">
                                            {{ selectedContact.name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 col-4">
                                <ul class="list-inline user-chat-nav text-end mb-0">

                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a @click="deleteConversation(selectedContact.id)"
                                                   class="dropdown-item">Delete <i
                                                    class="ri-delete-bin-line float-end text-muted"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end chat user head -->

                    <!-- start chat conversation -->
                    <div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
                        <ul class="list-unstyled mb-0">

                            <li v-for="(message,index) in messages" :key="index"
                                v-bind:class="{'right':selectedContact.id===message.receiver_id}">
                                <div class="conversation-list">
                                    <div v-if="selectedContact.id!==message.receiver_id" class="chat-avatar">
                                        <img :src="selectedContact.profile_photo" alt="">
                                    </div>

                                    <div class="user-chat-content">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    {{ message.message }}
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">{{ message.created_at }}</span>
                                                </p>
                                            </div>

                                            <div v-if="selectedContact.id!==message.sender_id"
                                                 class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                   data-bs-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a @click="deleteMessage(message.id)" class="dropdown-item">Delete
                                                        <i
                                                            class="ri-delete-bin-line float-end text-muted"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- end chat conversation end -->

                    <!-- start chat input section -->
                    <div class="chat-input-section p-3 p-lg-4 border-top mb-0">

                        <div class="row g-0">

                            <div class="col">
                                <input type="text" v-model="form.message"
                                       class="form-control form-control-lg bg-light border-light"
                                       placeholder="Enter Message...">
                            </div>
                            <div class="col-auto">
                                <div class="chat-input-links ms-md-2 me-md-0">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Emoji">
                                            <button type="button"
                                                    class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                                <i class="ri-emotion-happy-line"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Attached File">
                                            <button type="button"
                                                    class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                                <i class="mdi mdi-attachment"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button @click.prevent="sendMessage" type="submit"
                                                    :disabled="v$.$error"
                                                    class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                                <i class="mdi mdi-send"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.contact-users {
    display: flex;
    overflow-x: scroll;
}

.contact-users::-webkit-scrollbar {
    display: none;
}

.contact-users .item {
    width: 71px;
    margin-right: 16px;
}

.chat-conversation {
    overflow-y: scroll;
}
</style>

<script>
import axiosClient from "../helpers/axios";
import {computed, onMounted, reactive, ref} from "vue";
import useVuelidate from '@vuelidate/core'
import {required} from '@vuelidate/validators'
import {useStore} from "vuex";

export default {
    setup() {
        const store = useStore();
        const initialState = {
            message: '',
        }
        const form = reactive({...initialState});
        const selectedContact = ref({})

        onMounted(() => {
            store.dispatch("getUsers")
            store.dispatch("getContactUsers")
        })

        const users = computed(() => store.state.chat.users)
        const contactUsers = computed(() => store.state.chat.contactUsers)
        const messages = computed(() => store.state.chat.messages)

        const selectContact = async (contact) => {
            await store.dispatch("getMessages", contact.id)
            selectedContact.value = contact
            await store.dispatch("getContactUsers")
        }

        window.Echo.private('chat-channel')
            .listen('MessageEvent', (e) => {
                store.dispatch("getMessages", selectedContact ? selectedContact.value.id : e.message.receiver_id)
                store.dispatch("getContactUsers")
            })

        const rules = computed(() => {
            return {
                message: {required}
            }
        })

        const v$ = useVuelidate(rules, form)
        v$.value.$validate()

        const sendMessage = async () => {
            if (!v$.value.$error && selectedContact.value.id) {
                Object.assign(form, {
                    receiver_id: selectedContact.value.id
                })
                try {
                    let res = await axiosClient.post('admin/chat/sendMessage', form)
                    form.message = ''
                    await store.dispatch("getContactUsers")
                } catch (e) {
                    toast.toastMessage(e.response.status, e.response.data.message)
                }
            }
        }

        const deleteMessage = async (id) => {
            try {
                await axiosClient.delete('admin/chat/message/' + id)
                await store.dispatch("getMessages", selectedContact.value.id)
                await store.dispatch("getContactUsers")
            } catch (e) {
                toast.toastMessage(e.response.status, e.response.data.message)
            }
        }

        const deleteConversation = async (id) => {
            try {
                await axiosClient.delete('admin/chat/conversation/' + id)
                await store.dispatch("getMessages", selectedContact.value.id)
                await store.dispatch("getContactUsers")
            } catch (e) {
                toast.toastMessage(e.response.status, e.response.data.message)
            }
        }

        return {
            messages,
            users,
            contactUsers,
            form,
            v$,
            sendMessage,
            selectContact,
            selectedContact,
            deleteMessage,
            deleteConversation
        }
    }
}

</script>
