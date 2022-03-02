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

                <!-- Sezione commenti -->
                <div class="comment-section">
                  <div
                    class="comment-list"
                    v-if="post && post.comments && post.comments.length > 0"
                  >
                    <h3>Commenti</h3>
                    <ul>
                      <li v-for="comment in post.comments" :key="comment.id">
                        <h5 class="comment-author">
                          {{ comment.name }} ha scritto:
                        </h5>
                        <p class="comment-content">{{ comment.content }}</p>
                      </li>
                    </ul>
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
                      <div
                        class="bg-primary text-light p-3 my-3 rounded"
                        v-if="formErrors.content"
                      >
                        <ul>
                          <li v-for="(error, i) in formErrors.content" :key="i">
                            {{ error }}
                          </li>
                        </ul>
                      </div>

                      <button
                        type="submit"
                        class="w-25 m-auto button-link border-0"
                      >
                        Invia
                      </button>
                    </form>
                    <div
                      class="bg-dark text-light text-center my-3 p-3 rounded"
                      v-show="sentComment"
                    >
                      Commento in fase di approvazione. Grazie!
                    </div>
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
  name: "SinglePost",
  data() {
    return {
      post: {},
      formData: {
        name: "",
        content: "",
        post_id: null,
      },
      sentComment: false,
      formErrors: {},
    };
  },
  methods: {
    addComment() {
      // /api/comments
      axios
        .post("/api/comments", this.formData)
        .then((response) => {
          //pulisco i campi
          this.formData.name = "";
          this.formData.content = "";
          // mostro avviso commento inserito
          this.sentComment = true;
        })
        .catch((error) => {
          this.formErrors = error.response.data.errors;
          // console.log(error.response.data.errors);
        });
    },
  },
  created() {
    axios
      .get(`/api/posts/${this.$route.params.slug}`)
      .then((response) => {
        this.post = response.data;
        //post id per inserire commento
        this.formData.post_id = this.post.id;
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

      .comment-section {
        background-color: rgb(255, 159, 145);
        margin: 20px 0;
        padding: 20px;
        border-radius: 10px;

        .comment-list {
          ul {
            list-style: none;

            li {
              text-align: start;
              background-color: rgb(255, 113, 91);
              margin: 15px 0;
              padding: 10px;
              border-radius: 10px;
              display: flex;
              flex-direction: column;

              * {
                margin-bottom: 0;
              }
            }
          }
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
}
</style>