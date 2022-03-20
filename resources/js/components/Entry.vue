<template>
    <tr>
        <td v-text="entry.start"></td>
        <td v-text="entry.end"></td>
        <td v-text="timeSpent"></td>
    </tr>
</template>

<script>
import {secondsToHMS} from '../helpers'

export default {
    name: "Entry",
    props: ['entry'],
    data: () => ({
        now: Date.now()
    }),
    created() {
      setInterval(() => this.now = Date.now(), 1000)
    },
    computed: {
        timeSpent() {
            const endDate = this.entry.end === null ? this.now : new Date(this.entry.end);
            const diffSeconds = (endDate - new Date(this.entry.start)) / 1000
            return secondsToHMS(diffSeconds)
        }
    }
}
</script>
