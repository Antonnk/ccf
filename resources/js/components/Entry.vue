<template>
    <tr>
        <td v-text="entry.start"></td>
        <td v-text="entry.end"></td>
        <td>
            {{ timeSpent }}
        </td>
    </tr>
</template>

<script>
export default {
    name: "Entry",
    props: ['entry'],
    data: () => ({
        now: new Date()
    }),
    created() {
      setInterval(() => this.now = new Date(), 1000)
    },
    computed: {
        timeSpent() {
            const endDate = this.entry.end === null ? this.now : new Date(this.entry.end);
            const diffSeconds = (endDate - new Date(this.entry.start)) / 1000

            const secondsToHMS = function (secs) {
                function z(n) {
                    return (n < 10 ? '0' : '') + n;
                }

                var sign = secs < 0 ? '-' : '';
                secs = Math.abs(secs);
                return sign + z(secs / 3600 | 0) + ':' + z((secs % 3600) / 60 | 0) + ':' + z(Math.round(secs % 60));
            }

            return secondsToHMS(diffSeconds)
        }
    }
}
</script>
