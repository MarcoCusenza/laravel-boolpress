<template>
  <div class="single-post">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 py-4">
          <div class="card text-center">
            <div class="card-body">
              <div class="post-box">
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

                <div class="comment-form">
                  <h4>Aggiungi un commento</h4>
                  <form
                    @submit.prevent="addComment()"
                    class="d-flex flex-column"
                  >
                    <input
                      type="text"
                      id="name"
                      placeholder="Inserisci il tuo nickname"
                      class="mt-3 p-1"
                      v-model="formData.name"
                    />

                    <textarea
                      id="content"
                      cols="30"
                      rows="5"
                      placeholder="Inserisci il contenuto del commento"
                      class="my-3 p-1"
                      v-model="formData.content"
                    ></textarea>

                    <button
                      type="submit"
                      class="w-25 m-auto button-link border-0"
                    >
                      Invia
                    </button>
                  </form>
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
  name: "SinglePost",
  data() {
    return {
      post: {},
      formData: {
        name: "",
        content: "",
      },
    };
  },
  methods: {
    addComment() {
      // /api/comments
      axios
        .post("/api/comments", {
          params: this.formData,
        })
        .then((response) => {
          console.log(response);
        });
    },
  },
  created() {
    axios
      .get(`/api/posts/${this.$route.params.slug}`)
      .then((response) => {
        this.post = response.data;
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

      .comment-form {
        background-color: rgb(255, 113, 91);
        margin: 20px 0;
        padding: 20px;
        border-radius: 10px;
      }
    }
  }
}
</style>