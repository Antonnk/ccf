<template>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 v-text="project.name"></h4>
                </div>
                <div class="col-2">
                    <div class="text-right">
                        <button v-show="running" type="button" class="btn btn-sm btn-danger" @click.prevent="stopTimer">Stop</button>
                        <button v-show="!running" type="button" class="btn btn-sm btn-success" @click.prevent="startTimer">Start</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <textarea
                        ref="details"
                        v-html="project.details"
                        v-on:keydown.meta.83.capture.prevent.stop="updateDetails"
                        rows="20"
                        class="w-100"
                    ></textarea>
                    <button type="button" class="btn btn-sm btn-primary" @click.prevent="updateDetails">Save details</button>
                    <span class="help-text"> - or use <code>(cmd/win)+s</code> hotkey</span>
                </div>
                <div class="col-12 col-lg-6">
                    <table class="card-table table">
                        <thead>
                        <tr>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Time spent</th>
                        </tr>
                        </thead>
                        <tbody>
                            <entry v-for="(entry, key) in entries" :key="key" :entry="entry"></entry>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Entry from "./Entry";

export default {
    name: "Project",
    components: {
      'entry': Entry
    },
    props: ['project'],
    data: (vm) => ({
        running: vm.$props.project.is_running,
        entries: vm.$props.project.entries
    }),
    methods: {
        startTimer() {
            axios.post(`/projects/${this.project.id}/entry/start`)
                .then(() => this.running = true)
                .then(this.fetchEntries)
        },
        stopTimer() {
            axios.post(`/projects/${this.project.id}/entry/stop`)
                .then(() => this.running = false)
                .then(this.fetchEntries)
        },
        updateDetails() {
            axios.patch(`/projects/${this.$props.project.id}`, {
                details: this.$refs.details.value
            })
        },
        fetchEntries() {
            axios.get(`/projects/${this.$props.project.id}/entries`)
                .then(res => this.entries = res.data.entries)
        }
    }
}
</script>
