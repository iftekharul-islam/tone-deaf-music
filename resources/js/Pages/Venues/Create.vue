<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({}),
    },
    staffs: {
        type: Array,
        default: () => [],
    },
});

const successMessage = ref("");

const form = useForm({
    name: "",
    email: "",
    type: "",
    phone: "",
    lat: "",
    lng: "",
    website: "",
    address: "",
    description: "",
    is_private: false,
    is_active: false,
    staff_id: "",
});

const submit = () => {
    form.post(route("venues.store"), {
        onSuccess: () => {
            successMessage.value = "Venue created successfully.";
            form.reset(
                "name",
                "type",
                "email",
                "phone",
                "lat",
                "lng",
                "website",
                "address",
                "description",
                "is_private",
                "is_active",
                "staff_id"
            );
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
                            :href="route('venues')"
                            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                            >Venues</a
                        >
                    </li>
                    <li>
                        <span
                            class="mx-2 text-neutral-500 dark:text-neutral-400"
                            >/</span
                        >
                    </li>
                    <li class="text-neutral-500 dark:text-neutral-400">
                        Create
                    </li>
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
                                        for="type"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Type</label
                                    >
                                    <input
                                        v-model="form.type"
                                        name="type"
                                        type="text"
                                        id="type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Type"
                                    />
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
                                        for="phone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Phone number</label
                                    >
                                    <input
                                        v-model="form.phone"
                                        name="phone"
                                        type="text"
                                        id="phone"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Phone number"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="lat"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Latitude</label
                                    >
                                    <input
                                        v-model="form.lat"
                                        name="lat"
                                        type="text"
                                        id="lat"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Latitude"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="lng"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Longitude</label
                                    >
                                    <input
                                        v-model="form.lng"
                                        name="lng"
                                        type="text"
                                        id="lng"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Longitude"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="website"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Website URL</label
                                    >
                                    <input
                                        v-model="form.website"
                                        name="website"
                                        type="url"
                                        id="website"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Website URL"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="staff_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Select an option</label
                                    >
                                    <select
                                        v-model="form.staff_id"
                                        name="staff_id"
                                        id="staff_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option value="" disabled>
                                            Choose a staff
                                        </option>

                                        <option
                                            v-for="staff in props.staffs"
                                            :key="staff.id"
                                            :value="staff.id"
                                        >
                                            {{ staff.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex">
                                        <div class="flex items-center mr-4">
                                            <input
                                                v-model="form.is_private"
                                                name="is_private"
                                                id="is_private"
                                                type="checkbox"
                                                value="true"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label
                                                for="is_private"
                                                class="ml-2 text-sm font-medium text-gray-400 dark:text-gray-500"
                                                >Private</label
                                            >
                                        </div>
                                        <div class="flex items-center mr-4">
                                            <input
                                                v-model="form.is_active"
                                                name="is_active"
                                                id="is_active"
                                                type="checkbox"
                                                value="true"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label
                                                for="is_active"
                                                class="ml-2 text-sm font-medium text-gray-400 dark:text-gray-500"
                                                >Active</label
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start mb-6">
                                <textarea
                                    v-model="form.address"
                                    name="address"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Address"
                                ></textarea>
                            </div>
                            <div class="flex items-start mb-6">
                                <textarea
                                    v-model="form.description"
                                    name="description"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Description"
                                ></textarea>
                            </div>
                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
