import {createStore} from "vuex";
import axiosClient from "../helpers/axios";

const profileUrl = "/admin/profile"

const store = createStore({
    state: {
        user: {
            access_token: localStorage.getItem("access_token"),
        },
        profile: {
            data: {}
        },
        chat: {
            users: [],
            contactUsers: [],
            messages: []
        }
    },
    getters: {},
    actions: {
        login({commit}, user) {
            return axiosClient.post('/login', user)
                .then(({data}) => {
                    commit('SET_TOKEN', data.token)
                    return data;
                })
        },
        logout({commit}) {
            return axiosClient.post('/logout')
                .then((res) => {
                    commit('LOGOUT')
                    return res
                }).catch((err) => {
                    throw err;
                });
        },
        getProfile({state, commit}) {
            if (!Object.keys(state.profile.data).length) {
                return axiosClient.get(`${profileUrl}`)
                    .then((res) => {
                        commit('SET_PROFILE', res.data.data)
                        return res
                    }).catch((err) => {
                        throw err;
                    });
            }
        },
        updateProfile({commit}, data) {
            return axiosClient.post(`${profileUrl}/updateProfile`, data)
                .then((res) => {
                    commit('SET_PROFILE', res.data.data)
                    return res
                })
                .catch((err) => {
                    throw err;
                });
        },
        updatePassword({commit}, data) {
            return axiosClient.put(`${profileUrl}/updatePassword`, data)
                .then((res) => {
                    return res
                }).catch((err) => {
                    throw err;
                })
        },
        getUsers({commit}) {
            return axiosClient.get('admin/chat/users')
                .then((res) => {
                    commit('SET_USERS', res.data)
                    return res
                })
                .catch((err) => {
                    toast.toastMessage(err.response.status, err.response.data.message)
                    throw err;
                });
        },
        getContactUsers({commit}) {
            return axiosClient.get('admin/chat/contact-users')
                .then((res) => {
                    commit('SET_CONTACT_USERS', res.data.data)
                    return res
                })
                .catch((err) => {
                    toast.toastMessage(err.response.status, err.response.data.message)
                    throw err;
                });
        },
        getMessages({commit}, id) {
            return axiosClient.get(`admin/chat/messages/${id}`)
                .then((res) => {
                    commit('SET_MESSAGES', res.data)
                    return res
                })
                .catch((err) => {
                    toast.toastMessage(err.response.status, err.response.data.message)
                    throw err;
                });
        }
    },
    mutations: {
        LOGOUT: (state) => {
            state.user.access_token = null;
            localStorage.removeItem("access_token");
        },
        SET_TOKEN: (state, token) => {
            state.user.access_token = token;
            localStorage.setItem('access_token', token);
        },
        SET_PROFILE: (state, data) => {
            state.profile.data = data;
        },
        SET_USERS: (state, data) => {
            state.chat.users = data
        },
        SET_CONTACT_USERS: (state, data) => {
            state.chat.contactUsers = data
        },
        SET_MESSAGES: (state, data) => {
            state.chat.messages = data
        },
        SET_NEW_MESSAGE: (state, data) => {
            state.chat.messages.push(data)
        }
    }
});

export default store;
