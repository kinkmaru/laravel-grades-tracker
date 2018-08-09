<template>
    <div style="display:inline-block;">
        <button class="btn btn-success" v-on:click="showModal(modalID)">Details</button>

        <modal :name="createModalID(modalID, 'detailAssignment')" :draggable="true">
            <h2>Assignment Details</h2>
            <table class="table table-hover">
                <thead>
                    <th v-for="columns in scoreHeaders" >
                        {{columns}}
                    </th>
                </thead>
                <tbody>
                    <tr v-for="assignments in scoreDetails">
                        <td>{{assignments.name}}</td>
                        <td>{{assignments.max_score}}</td>
                        <td>{{assignments.achieved_score}}</td>
                        <td>{{assignments.grade}}</td>
                        <td>{{assignments.assignment_weight}}</td>
                        <td>{{assignments.weighted_grade}}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>-Add Totals-</td>
                    </tr>
                </tbody>
            </table>

            <button v-on:click="hideModal(modalID)">Close</button>

        </modal>
    </div>
</template>

<script>
    export default {
        data:
            function() {
                return{
                    weight: ''
                }
            },
        props: {
            scoreDetails: {},
            sectionWeight: '',
            sectionCount: '',
            scoreHeaders: {type: Array, default: []},
            modalID: Number
        },
        methods: {
            weightCalc(total, actual){
                return ((total / actual)* (this.sectionWeight / this.sectionCount)).toFixed(2);
            },
            showModal (id) {
                this.$modal.show('detailAssignment' + id);
            },
            hideModal (id) {
                this.$modal.hide('detailAssignment' + id);
            },
            createModalID (id, string){
                return string + id;
            }
        }
    }
</script>

<style scoped>

</style>