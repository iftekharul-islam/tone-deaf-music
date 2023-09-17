<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({}),
    },
    user: {
        type: Object,
        default: () => ({}),
    },
});

const successMessage = ref("");

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    password: "",
    password_confirmation: "",
    role: props.user?.roles[0]?.name,
});

const submit = () => {
    form.put(route("users.update", props.user?.id), {
        onSuccess: () => {
            successMessage.value = "User updated successfully.";
            form.reset("password", "password_confirmation");
        },
    });
};
</script>

<template>
    <Head title="Venue create" />

    <AuthenticatedLayout :permissions="props.permissions">
        <template #header>
            <!--Third breadcrumb-->
            <nav class="w-full rounded-md">
                <ol class="list-reset flex">
                    <li>
                        <a
                            :href="route('dashboard')"
                            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                            >Dashboard</a
                        >
                    </li>
                    <li>
                        <span
                            class="mx-2 text-neutral-500 dark:text-neutral-400"
                            >/</span
                        >
                    </li>
                    <li>
                        <a
                            :href="route('users')"
                            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                            >Users</a
                        >
                    </li>
                    <li>
                        <span
                            class="mx-2 text-neutral-500 dark:text-neutral-400"
                            >/</span
                        >
                    </li>
                    <li class="text-neutral-500 dark:text-neutral-400">Edit</li>
                </ol>
            </nav>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div
                            v-if="successMessage"
                            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert"
                        >
                            {{ successMessage }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label
                                        for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Name</label
                                    >
                                    <input
                                        v-model="form.name"
                                        name="name"
                                        type="text"
                                        id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Name*"
                                    />

                                    <p
                                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                                    >
                                        {{ form.errors.name }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Email</label
                                    >
                                    <input
                                        v-model="form.email"
                                        name="email"
                                        type="email"
                                        id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Email*"
                                    />
                                    <p
                                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                                    >
                                        {{ form.errors.email }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        for="role"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Select an option</label
                                    >
                                    <select
                                        v-model="form.role"
                                        name="role"
                                        id="role"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option value="" disabled>
                                            Choose a role
                                        </option>
                                        <option value="admin">Admin</option>
                                        <option value="venue_managers">
                                            Venue Managers
                                        </option>
                                        <option value="venue_staff">
                                            Venue Staff
                                        </option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Password</label
                                >
                                <input
                                    v-model="form.password"
                                    type="password"
                                    id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Password"
                                />
                            </div>
                            <div class="mb-6">
                                <label
                                    for="confirm_password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Confirm password</label
                                >
                                <input
                                    v-model="form.password_confirmation"
                                    type="password"
                                    id="confirm_password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Confirm password"
                                />
                            </div>

                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
