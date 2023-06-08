<template>
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-12">
            <div id="custCarousel" class="carousel slide" data-bs-ride="carousel" align="center">
                <!-- slides -->
                <div class="carousel-inner">
                    <div v-for="(image, index) in images" :key="image.id"
                        :class="'carousel-item ' + (index == 0 ? 'active' : '')">
                        <img
                            :src="getStoragePath(images_route + image.path)"
                            alt
                        />
                    </div>
                    <div v-if="(!images || images.length < 1)"
                        class="carousel-item active">
                        <img
                            :src="getAvatar(icon_name)"
                            alt
                        />
                    </div>
                </div>

                <!-- Left right -->
                <a class="carousel-control-prev" href="#custCarousel" data-bs-slide="prev" v-if="(images && images.length > 1)">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#custCarousel" data-bs-slide="next" v-if="(images && images.length > 1)">
                <span class="carousel-control-next-icon"></span>
                </a>

                <!-- Thumbnails -->
                <ol class="carousel-indicators list-inline">
                    <li :class="'list-inline-item ' + (index == 0 ? 'active' : '')" v-for="(image, index) in images" :key="image.id">
                        <a :id="'carousel-selector-' + index" :class="(index == 0 ? 'selected' : '')" :data-bs-slide-to="index" data-bs-target="#custCarousel">
                        <img :src="getStoragePath(images_route + image.path)" class="img-fluid">
                        </a>
                    </li>
                </ol>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        images: Array,
        images_route: String,
        icon_name: String,
    },
}
</script>

<style scoped>
  .carousel-inner img {
      width: 100%;
      height: 350px;
  }

#custCarousel .carousel-indicators {
    position: static;
    margin-top: 10px;
    width: 100%;
    height: 50px;
    margin-left: 0px;
}

#custCarousel .carousel-indicators > li {
    width: 100%;
    height: 100%;
}

 #custCarousel .carousel-indicators li img {
    display: block;
    height: 100%;
 }

  #custCarousel .carousel-indicators li.active img {
    opacity: 1;
  }

  #custCarousel .carousel-indicators li:hover img {
    opacity: 0.75;
  }
</style>
