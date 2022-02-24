<template>
  <div class="post-list">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 py-4">
          <div class="card text-center">
            <div class="card-body">
              <div class="post-box" v-for="post in posts" :key="post.id">
                <h4 class="title">{{ post.title }}</h4>
                <img
                  v-if="post.image"
                  :src="
                    post.image
                      ? 'storage/' + post.image
                      : 'https://via.placeholder.com/150'
                  "
                  :alt="post.title"
                />
                <p>{{ post.content }}</p>
                <div class="details-box">
                  <div v-if="post.category">
                    <strong>Categoria:</strong> {{ post.category.name }}
                  </div>
                  <div v-if="post.tags">
                    <strong>Tag:</strong>
                    <span class="tag" v-for="(tag, i) in post.tags" :key="i">
                      {{ tag.name
                      }}<span v-if="i < post.tags.length - 1">,</span>
                    </span>
                  </div>
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
  name: "PostList",
  data() {
    return {
      posts: [],
    };
  },
  created() {
    axios.get("/api/posts").then((response) => {
      this.posts = response.data;
    });
  },
};
</script>

<style lang="scss" scoped>
.card {
  border: none;
  border-radius: 10px;

  .card-body {
    display: grid;
    grid-template: 1fr / repeat(2, 1fr);
    gap: 30px 40px;
    padding: 60px;
    border-radius: 10px;
    background-color: rgb(30, 168, 150);

    .post-box {
      background-color: #524848;
      border-radius: 10px;
      color: #ffffff;
      padding: 30px;

      .title {
        font-size: 30px;
        font-weight: bold;
      }

      img {
        max-height: 200px;
        max-width: 100%;
        margin: 20px 0;
      }

      .details-box {
        text-align: left;
      }
    }
  }
}
</style>