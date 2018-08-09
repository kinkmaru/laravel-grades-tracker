<template>
    <div id="app">
        <h2><u>Class Details</u></h2>
        <!-- Change section modal to create an overview of all sections ; ensure total reaches 100% -->
        <sectionModalComponent :showModal="canSee"
                               :sectionID="classID"
                               v-on:updateTable="getSectionData()">
        </sectionModalComponent>

        <newAssignmentModalComponent :showModal="canSee"
                                     :modalData="sectionData"
                                     v-on:updateTable="getSectionData()">
        </newAssignmentModalComponent>
        <div v-for="sections in sectionData">
            <b>{{sections.section.name }} - {{sections.section.section_weight}} </b>
            <b v-if="sections.section.current_progress > 0">| Current Progress: {{sections.section.current_progress}}</b>
            <b v-else="sections.section.section_weight <= 0">| Current Progress: No Entries</b>

            <scoreDetailsComponent :showModal="canSee"
                                   :scoreHeaders="assignmentDetailsHeaders"
                                   :scoreDetails="sections.assignment"
                                   :sectionWeight="sections.section.section_weight"
                                   :sectionCount="sections.assignment.length"
                                   :modalID="sections.section.id">
            </scoreDetailsComponent>

            <!--<EditDatabaseComponent :formData="sections.section"></EditDatabaseComponent>-->

            <button class="btn btn-danger" v-on:click="deleteData(sections.section.id)">Delete</button>


            <tableComponent :columnData="assignmentHeaders"
                            :tableData="sections.assignment"
                            :editPath="uri"
                            :databaseEdits="assignmentEditColumns"
                            :componentName="editDataComponentName"
                            v-on:updateTable="getSectionData()">
            </tableComponent>
        </div>
    </div>
</template>

<script>
    import tableComponent from './TableComponent.vue';
    import sectionModalComponent from './NewSectionsModal.vue';
    import newAssignmentModalComponent from './NewAssignmentModal.vue';
    import scoreDetailsComponent from './AssignmentDetailsComponent';
    import EditDatabaseComponent from './EditDatabaseComponent.vue';

    export default {
        data: function () {
            return {
                sectionColumns: ['Name', 'Section_Weight', 'Current_Progress', 'Actions'],
                assignmentHeaders: ['Name', 'Max_Score', 'Achieved_Score', 'Grade', 'Actions'],
                assignmentDetailsHeaders: ['Name', 'Max_Score', 'Achieved_Score', 'Grade', 'Assignment_Weight', 'Weighted_Grade'],
                sectionUri: this.$route.path,
                uri: '/api/classes/details/assignments/',
                canSee: false,
                sectionData: [],
                sectionInsert: '/api/classes/details/' + this.classID,
                assignmentEditColumns: ['name', 'max_score', 'achieved_score'],
                editDataComponentName: 'editAssignment'
            }
        },
        props: {
            classID: [String, Number]
        },
        created: function () {
            this.getSectionData()
        },
        methods: {
            deleteData(id){
                let uri = '/api/classes/details/' + id;
                this.axios.delete(uri).then((response) => {
                    this.sectionData = response.data;
                });
            },
            getSectionData() {
                let uri = '/api/classes/details/' + this.classID;
                this.axios.get(uri).then((response) => {
                    this.sectionData = response.data;
                });
            },
        },
        components: {
            tableComponent,
            sectionModalComponent,
            newAssignmentModalComponent,
            scoreDetailsComponent,
            EditDatabaseComponent
        }
    }
</script>