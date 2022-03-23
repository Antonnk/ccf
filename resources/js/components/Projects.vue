<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4>Projects</h4>
                    </div>
                    <div class="col-2">
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-success" @click.prevent="addProject">Add project</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="card-table table">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Entries</th>
                    <th>Total time</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects">
                        <td v-text="project.name"></td>
                        <td v-text="project.entries.length"></td>
                        <td v-text="secondsToHMS(project.time_spent)"></td>
                        <td class="text-right">
                            <button type="button" class="btn btn-sm btn-dark" @click.prevent="editProject(project)">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            <a :href="`/projects/${project.id}`" class="btn btn-sm btn-secondary">Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <add-project ref="add" @success="fetchProjects"></add-project>
        <edit-project ref="edit" @success="fetchProjects"></edit-project>
    </div>
</template>

<script>
import AddProject from "./AddProject";
import EditProject from "./EditProject";
import {secondsToHMS} from "../helpers";

export default {
    name: "Projects",
    components: {
        'add-project': AddProject,
        'edit-project': EditProject
    },
    props: ['init-projects'],
    data: () => ({
        projects: []
    }),
    created() {
      this.projects = this.initProjects
    },
    methods: {
        addProject() {
            this.$refs.add.open();
        },
        editProject(project) {
            this.$refs.edit.open(project);
        },
        secondsToHMS(value) {
            return secondsToHMS(value);
        },
        fetchProjects() {
            axios.get(`/projects`)
                .then(res => this.projects = res.data.projects)
        }
    }
}
</script>
