<template>
    <div>
        <div class="form-group">
            <label>Date and time:</label>
            <div class="input-group date" id="datetime" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetime">
                <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        date: {
            type: String,
            default: null
        },
    },

    watch: {
        date(newVal) {
            if (newVal !== null) {
                $('#datetime > input').val(newVal);
            }
        }
    },

    methods: {
        submitForm() {
            let sDatetime = $('#datetime > input').val();
            if (sDatetime !== '') {
                this.$emit('datetime-data', sDatetime);
                return true;
            }
            return false;
        },
    },

    mounted() {
        $('#datetime').datetimepicker({
            icons: { time: 'far fa-clock' },
            format: 'YYYY-MM-DD HH:mm:ss',
        });
    }
}
</script>
