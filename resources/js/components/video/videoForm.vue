<template>
    <div class="d-flex flex-wrap">
        <div class="col-12 col-xl-8 mb-2">
            <input v-model.lazy="sCustomVideoUrl" type="text" class="col-12 w-full px-4 form-control mb-2" placeholder="Paste Video URL here...">

            <video-player :video-url="getVideoURL" />
        </div>

        <div class="col-12 col-xl-4">
            <video-carousel :playlist="aPlaylists.thumbnails" @update-default-link="updateDefaultLink" />
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import videoPlayer from './forms/videoPlayer';
import videoCarousel from './forms/videoCarousel';

export default {
    data() {
        return {
            aPlaylists: [],
            sCustomVideoUrl: '',
            sDefaultVideoUrl: '',
        }
    },

    components: {
        videoPlayer,
        videoCarousel,
    },

    computed: {
        getVideoURL() {
            return this.sCustomVideoUrl === '' ? this.sDefaultVideoUrl : this.sCustomVideoUrl;
        }
    },

    methods: {
        updateDefaultLink(sTitle) {
            let index = this.aPlaylists.video_links.findIndex((s) => {
                return s.includes(sTitle);
            });

            if (index === -1) {
                return 'not found';
            }
            return this.sDefaultVideoUrl = this.aPlaylists.video_links[index];
        }
    },

    mounted() {
        axios.get('/admin/api/videos')
            .then(res => {
                let aList = res.data;
                this.aPlaylists = aList;
                this.sDefaultVideoUrl = this.aPlaylists.video_links[0];
            });
    }
}
</script>
