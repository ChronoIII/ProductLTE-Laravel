<template>
    <video v-if="videoUrl !== ''" id="my-player" class="video-js" fluid="true" aspectRatio="16:9" preload="auto" controls>
        <source :src="videoUrl" type="video/mp4" />
        <source :src="videoUrl" type="video/webm" />
        <source :src="videoUrl" type="video/ogg" />

        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank">
            supports HTML5 video
            </a>
        </p>
    </video>
</template>

<script>
import videojs from 'video.js';

export default {
    props: {
        videoUrl: {
            type: String,
            required: true,
        }
    },

    data() {
        return {
            videoPlayer: null,
        }
    },

    components: {
        videojs
    },

    watch: {
        videoUrl(data) {
            if (data !== '') {
                this.$nextTick(() => {
                    let options = {};
                    this.videoPlayer = videojs('my-player', options);

                    this.videoPlayer.src(data);
                })
            }

        }
    },

    beforeUnmount() {
        if (this.videoUrl !== '') {
            this.videoPlayer.dispose();
        }
    }
}
</script>
