<script setup>
import {
    VENUES_VIEW,
    VENUES_CREATE,
    VENUES_UPDATE,
    VENUES_DELETE,
} from "@/constants/permissions";
import { hasPermissionTo } from "@/helpers/utils";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({}),
    },
    venues: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({});

const onClickedDelete = (id) => {
    if (confirm("Are you sure you want to delete this venue?")) {
        form.delete(route("venues.destroy", id));
    }
};
</script>

<template>
    <Head title="Venues" />

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
                    <li class="text-neutral-500 dark:text-neutral-400">
                        Venues
                    </li>
                </ol>
            </nav>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <template
                            v-if="
                                hasPermissionTo(
                                    VENUES_CREATE,
                                    props.permissions
                                )
                            "
                        >
                            <Link
                                :href="route('venues.create')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            >
                                Create
                            </Link>
                        </template>

                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div
                                    class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
                                >
                                    <div class="overflow-hidden">
                                        <table
                                            class="min-w-full text-left text-sm font-light border"
                                        >
                                            <thead
                                                class="border-b border-neutral-100 font-medium dark:border-neutral-500"
                                            >
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-4"
                                                    >
                                                        #
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-4"
                                                    >
                                                        Owner
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-4"
                                                    >
                                                        Name
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-4"
                                                    >
                                                        Email
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-4"
                                                    >
                                                        Created On
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-4"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template
                                                    v-for="(
                                                        venue, index
                                                    ) in props.venues"
                                                    :key="index"
                                                >
                                                    <tr
                                                        class="border-b dark:border-neutral-500"
                                                    >
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 font-medium"
                                                        >
                                                            {{ venue?.id }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                venue?.owner
                                                                    ?.name
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{ venue?.name }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{ venue?.email }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                venue?.created_at
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            <div
                                                                class="inline-flex"
                                                                role="group"
                                                            >
                                                                <!-- VENUES_VIEW -->
                                                                <template
                                                                    v-if="
                                                                        hasPermissionTo(
                                                                            VENUES_VIEW,
                                                                            props.permissions
                                                                        )
                                                                    "
                                                                >
                                                                    <Link
                                                                        :href="
                                                                            route(
                                                                                'venues.show',
                                                                                venue?.id
                                                                            )
                                                                        "
                                                                        class="inline-block rounded-l border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                                    >
                                                                        View
                                                                    </Link>
                                                                </template>
                                                                <!-- VENUES_UPDATE -->
                                                                <template
                                                                    v-if="
                                                                        hasPermissionTo(
                                                                            VENUES_UPDATE,
                                                                            props.permissions
                                                                        )
                                                                    "
                                                                >
                                                                    <Link
                                                                        :href="
                                                                            route(
                                                                                'venues.edit',
                                                                                venue?.id
                                                                            )
                                                                        "
                                                                        class="inline-block rounded-l border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                                    >
                                                                        Edit
                                                                    </Link>
                                                                </template>

                                                                <!-- VENUES_DELETE -->
                                                                <template
                                                                    v-if="
                                                                        hasPermissionTo(
                                                                            VENUES_DELETE,
                                                                            props.permissions
                                                                        )
                                                                    "
                                                                >
                                                                    <button
                                                                        @click="
                                                                            onClickedDelete(
                                                                                venue?.id
                                                                            )
                                                                        "
                                                                        type="button"
                                                                        class="-ml-0.5 inline-block border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                                        data-te-ripple-init
                                                                        data-te-ripple-color="light"
                                                                    >
                                                                        Delete
                                                                    </button>
                                                                </template>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
