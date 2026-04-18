<template>
    <div class="row g-0 auth-row">
        <div class="col-lg-6">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Login For Chat System</h1>
                    </div>
                    <div class="cover-image">
                        <img src="../assets/signin-image.svg" alt="">
                    </div>
                    <div class="shape-image">
                        <img src="../assets/shape.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-6">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Login</h6>
                    <form @submit.prevent="loginUser">

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="email">Email</label>
                                    <input
                                        v-model="form.email"
                                        class="form-control"
                                        v-bind:class="{'is-invalid':v$.email.$error}"
                                        type="email"
                                        id="email"
                                        placeholder="Email"
                                    >
                                    <div v-if="v$.email.$error" class="invalid-feedback">
                                        <strong>{{ v$.email.$errors[0].$message }}</strong>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="password">Password</label>
                                    <input
                                        v-model="form.password"
                                        type="password"
                                        class="form-control"
                                        v-bind:class="{'is-invalid':v$.password.$error}"
                                        id="password"
                                        placeholder="Password"
                                    >
                                    <div v-if="v$.password.$error" class="invalid-feedback">
                                        <strong>{{ v$.password.$errors[0].$message }}</strong>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember Password
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="">Forgot Your Password ?</a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <button type="submit" :disabled="isSubmitting" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, computed, ref} from "vue";
import useVuelidate from '@vuelidate/core'
import {required, email, minLength, helpers} from '@vuelidate/validators'
import {useRouter} from "vue-router"
import {useStore} from "vuex"

export default {
    setup() {
        const store = useStore()
        const router = useRouter();
        const isSubmitting = ref(false)
        const form = reactive({
            email: '',
            password: ''
        })

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage('The email field is required', required),
                    email: helpers.withMessage('Please enter valid email', email)
                },
                password: {
                    required: helpers.withMessage('The password field is required', required),
                    minLength: helpers.withMessage('The password must be at least 7 characters.', minLength(7))
                }
            }
        })

        const v$ = useVuelidate(rules, form)

        const loginUser = async () => {
            v$.value.$validate()

            if (!v$.value.$error) {
                isSubmitting.value = true
                try {
                    await store.dispatch("login", form);
                    toast.toastMessage(200, "Signed in successfully")
                    await router.push({name: 'ChatIndex'})
                } catch (e) {
                    toast.toastMessage(e.response.status, e.response.data.message)
                }
                isSubmitting.value = false
            }
        }

        return {
            form, loginUser, v$, isSubmitting
        }
    }
}
</script>
