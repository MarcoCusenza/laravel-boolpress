<template>
  <div class="single-category">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 py-4">
          <div class="card text-center">
            <div class="card-body">
              <div class="category-box">
                <h2 class="name my-4">Categoria: {{ category.name }}</h2>
                <h3>Post con questa categoria:</h3>
                <div class="posts-box" v-if="category.posts.length > 0">
                  <div
                    class="single-post-box"
                    v-for="(post, i) in category.posts"
                    :key="i"
                  >
                    <h4 class="title">{{ post.title }}</h4>
                    <img
                      v-if="post.image"
                      :src="
                        post.image
                          ? '../storage/' + post.image
                          : 'https://via.placeholder.com/150'
                      "
                      :alt="post.title"
                    />
                    <p>{{ post.content }}</p>
                  </div>
                </div>
                <div class="no-posts" v-else>
                  <h4 class="bg-primary rounded">Nessun Post</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleCategory",
  data() {
    return {
      category: {},
    };
  },
  created() {
    axios
      .get(`/api/categories/${this.$route.params.slug}`)
      .then((response) => {
        this.category = response.data;
      })
      .catch((error) => {
        this.$router.push({ name: "page-404" });
      });
  },
};
</script>

<style lang="scss" scoped>
.card {
  border: none;
  border-radius: 10px;

  .card-body {
    padding: 60px;
    border-radius: 10px;
    background-color: rgb(30, 168, 150);

    .category-box {
      background-color: #524848;
      border-radius: 10px;
      color: #ffffff;
      padding: 30px;

      .name {
        font-size: 30px;
        font-weight: bold;
      }

      .posts-box {
        display: grid;
        grid-template: 1fr / repeat(2, 1fr);
        gap: 30px 40px;
        padding: 60px;
        border-radius: 10px;
        background-color: rgb(30, 168, 150);

        .single-post-box {
          background-color: #524848;
          border-radius: 10px;
          color: #ffffff;
          padding: 30px;

          .title {
            font-size: 30px;
            font-weight: bold;
          }

          img {
            height: 200px;
            aspect-ratio: 1;
            object-fit: cover;
            margin: 20px 0;
            border-radius: 50%;
          }

          .details-box {
            text-align: left;
          }
        }
      }
    }
  }
}
</style>