<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-body">
                            <div v-if="status" class="alert alert-success">
                                {{ status }}
                            </div>
                            <form @submit.prevent="submit">
                                <div class="mb-3">
                                    <label for="email" class="form-label"
                                        >Email</label
                                    >
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        v-model="form.email"
                                        required
                                        autofocus
                                    />
                                    <p
                                        class="text-danger"
                                        v-if="form.errors.email"
                                        v-text="form.errors.email"
                                    ></p>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        required
                                        v-model="form.password"
                                    />
                                    <p
                                        class="text-danger"
                                        v-if="form.errors.password"
                                        v-text="form.errors.password"
                                    ></p>
                                </div>
                                <div class="form-check">
                                    <input
                                        id="remember"
                                        type="checkbox"
                                        class="form-check-input"
                                        v-model="form.remember"
                                    />
                                    <label
                                        for="remember"
                                        class="form-check-label"
                                        >Remember me</label
                                    >
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-end mt-4"
                                >
                                    <!-- <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="btn btn-link"
                                >
                                    Forgot your password?
                                </Link> -->
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Log in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
