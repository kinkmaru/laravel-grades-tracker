<template>
    <div style="display:inline-block;">
        <button class="btn btn-success" v-on:click="showModal(modalID)">Details</button>

        <modal :name="createModalID(modalID, 'detailAssignment')" :draggable="true">
            <h2>Assignment Details</h2>
            <table class="table table-hover"  v-if="scoreDetails.length >= 1">
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
                        <td>Summary</td>
                        <td>{{totalMaxScore}}</td>
                        <td>{{totalAchievedScore}}</td>
                        <td>{{totalGrade}}</td>
                        <td>{{totalWeight}}</td>
                        <td>{{totalWeightedGrade}}</td>
                    </tr>
                </tbody>
            </table>
            <table v-else>
                There no assignments to display.
            </table>

            <button v-on:click="hideModal(modalID)">Close</button>

        </modal>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                weight: '',
                totalMaxScore: 0,
                totalAchievedScore: 0,
                totalGrade: 0,
                totalWeight: 0,
                totalWeightedGrade: 0
            }
        },
        props: {
            scoreDetails: {},
            sectionWeight: '',
            sectionCount: '',
            scoreHeaders: {type: Array, default: []},
            modalID: Number
        },
        created: function() {
            this.tallyTotals(this.scoreDetails);
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
            },
            tallyTotals(scoreDetails) {
                let mc, ac, g, w, wg, count;
                mc = ac = g = w = wg = count = 0;

                scoreDetails.forEach(function(score) {
                    debugger;
                    mc += parseFloat(score['max_score']);
                    ac += parseFloat(score['achieved_score']);
                    g += parseFloat(score['grade']);
                    w += parseFloat(score['assignment_weight']);
                    wg += parseFloat(score['weighted_grade']);
                    count++;
                });
                this.totalMaxScore = mc.toFixed(2);
                this.totalAchievedScore = ac.toFixed(2);
                this.totalGrade = (g / count).toFixed(2);
                this.totalWeight = w.toFixed(2);
                this.totalWeightedGrade = wg.toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>