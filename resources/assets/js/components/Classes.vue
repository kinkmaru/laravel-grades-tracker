<template>
    <div id="app">
        <h2><u>All Classes</u></h2>
        <newGoalComponent :showModal="canSee"
                          v-on:updateTable="getGoalData()"></newGoalComponent>

        <tableComponent :columnData="columns"
                        :tableData="goalData"
                        :routerPath="nextDetails"
                        :deletePath="uri"
                        :editPath="editPath"
                        :databaseEdits="classEditColumns"
                        :componentName="editDataComponentName"
                        :colorCompare="colorCompare" v-on:updateTable="getGoalData()">
        </tableComponent>
    </div>
</template>

<script>
    import tableComponent from './TableComponent.vue';
    import newGoalComponent from './NewClassModal.vue';

    export default {
        data:
            function () {
                return {
                    columns: ['Name', 'Target_Grade', 'Actual_Grade', 'Actions'],
                    colorCompare: ['target_grade','actual_grade'],
                    canSee: false,
                    uri: '/api/classes/delete/',
                    nextDetails: 'ClassDetails',
                    goalData: [],
                    editPath: '/api/classes/',
                    classEditColumns: ['name', 'target_grade'],
                    editDataComponentName: 'editClass'
                }
            },
        props: {
        },
        created: function () {
            this.getGoalData();
        },
        methods: {
            getGoalData() {
                let uri = '/api/classes';
                this.axios.get(uri).then((response) => {
                    this.goalData = response.data;
                });
            },
        },
        components: {
            tableComponent,
            newGoalComponent,
        }
    }
</script>