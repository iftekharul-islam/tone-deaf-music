<script setup>
import { USERS_CREATE, USERS_UPDATE } from "@/constants/permissions";
import { hasPermissionTo } from "@/helpers/utils";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({}),
    },
    users: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Users" />

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
                        Users
                    </li>
                </ol>
            </nav>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Create -->
                        <template
                            v-if="
                                hasPermissionTo(USERS_CREATE, props.permissions)
                            "
                        >
                            <Link
                                :href="route('users.create')"
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
                                                class="border-b border-t border-neutral-100 font-medium dark:border-neutral-500"
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
                                                        Role
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
                                                        user, index
                                                    ) in props.users"
                                                    :key="index"
                                                >
                                                    <tr
                                                        class="border-b dark:border-neutral-500"
                                                    >
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4 font-medium"
                                                        >
                                                            {{ user?.id }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{ user?.name }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{ user?.email }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                user?.roles[0]
                                                                    ?.name
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            {{
                                                                user?.created_at
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-6 py-4"
                                                        >
                                                            <div
                                                                class="inline-flex"
                                                                role="group"
                                                            >
                                                                <!-- USERS_UPDATE -->
                                                                <template
                                                                    v-if="
                                                                        hasPermissionTo(
                                                                            USERS_UPDATE,
                                                                            props.permissions
                                                                        )
                                                                    "
                                                                >
                                                                    <Link
                                                                        :href="
                                                                            route(
                                                                                'users.edit',
                                                                                user?.id
                                                                            )
                                                                        "
                                                                        class="inline-block rounded-l border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                                    >
                                                                        Edit
                                                                    </Link>
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
