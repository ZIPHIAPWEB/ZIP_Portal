<script setup lang="ts">
</script>

<template>
    <table class="table table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th style="width: 50%">Requirement</th>
                <th class="text-center">
                    Status
                </th>
                <th class="text-center">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in 5">
                <td>Test</td>
                <td class="text-center">
                    <span v-if="false" class="fa fa-times text-red"></span>
                    <span v-else class="fa fa-check text-success"></span>
                </td>
                <td class="text-center">
                    <button class="btn btn-success btn-xs mr-1">Upload</button>
                    <button class="btn btn-warning btn-xs mr-1">View</button>
                    <button class="btn btn-primary btn-xs mr-1">Download</button>
                    <button class="btn btn-danger btn-xs mr-1">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>