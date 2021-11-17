<template>
    <table
        v-if="users.length > 0"
        class="border border-green-100 text-center table-fixed"
    >
        <thead>
            <tr>
                <th class="border border-green-100 py-1">Id</th>
                <th class="border border-green-100 py-1">Name</th>
                <th class="border border-green-100 py-1">Email</th>
                <th class="border border-green-100 py-1">Phone number</th>
                <th class="border border-green-100 py-1">Address</th>
                <th class="border border-green-100 py-1">City</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td class="border border-green-100 px-8 py-2">{{ user.id }}</td>
                <td class="border border-green-100 px-8 py-2">
                    {{ user.name }}
                </td>
                <td class="border border-green-100 px-8 py-2">
                    {{ user.email }}
                </td>
                <td class="border border-green-100 px-8 py-2">
                    {{ user.phone }}
                </td>
                <td class="border border-green-100 px-8 py-2">
                    {{ user.address }}
                </td>
                <td class="border border-green-100 px-8 py-2">
                    {{ user.city }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ["users"],
};
</script>

<style></style>
