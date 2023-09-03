<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <template v-for="(data, index) in playlist">
                        <img :src="data" @click.prevent="activePlay = index" :class="['col-4 col-xl-12 mt-xl-3 py-2 rounded border-hover cursor-pointer', {'active': this.activePlay === index}]" />
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        playlist: {
            type: Array,
            default: []
        }
    },

    watch: {
        activePlay(newVal) {
            let aParts = this.playlist[newVal].split('/');
            let sMusicTitle = aParts[aParts.length - 1].split('.')[0];
            this.$emit('update-default-link', sMusicTitle);
        }
    },

    data() {
        return {
            activePlay: 0,
        }
    },
}
</script>

<style>
.cursor-pointer {
    cursor: pointer;
}

.border-hover {
    border: 1px solid transparent;
}

.border-hover:hover {
    border: 1px solid #3333;
}

.active {
    border: 1px solid #333a;
}
</style>
