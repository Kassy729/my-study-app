<template>
  <div>
    <div>
      <label for="exampleFormControlInput1" class="form-label">댓글</label>
      <table class="table table-hover mt-5">
        <thead>
          <tr>
            <th scope="col">내용</th>
            <th scope="col">작성자</th>
            <th scope="col">삭제</th>
          </tr>
        </thead>
        <tbody v-for="comment in comments" :key="comment.id">
          <tr>
            <td>{{ comment.comment }}</td>
            <td>{{ comment.user.name }}</td>

            <td>
              <button class="btn btn-danger" @click="onClickDelete(comment.id)">
                삭제
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="mb-3">
      <form @submit.prevent="onClickSubmit">
        <input
          type="text"
          class="form-control"
          v-model="comment"
          id="exampleFormControlInput1"
          placeholder="댓글"
        />
        <button class="btn btn-primary mt-2">작성</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      comment: "",
      comments: [],
    };
  },

  created() {
    this.getComment();
  },
  props: ["post"],
  methods: {
    onClickSubmit() {
      const form = new FormData();
      form.append("comment", this.comment);
      form.append("user_id", this.$store.state.auth.user.user.id);
      axios
        .post("http://35.76.24.183/api/comment/" + this.post.id, form)
        .then(() => {
          this.comment = "";
          this.getComment();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getComment() {
      axios
        .get("http://35.76.24.183/api/comment/" + this.post.id)
        .then((res) => {
          this.comments = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    onClickDelete(id) {
      if (confirm("Are you sure to delete")) {
        axios
          .delete("http://35.76.24.183/api/comment/" + id)
          .then(() => {
            // this.$emit("deleted");
            // this.$parent.getComment();
            this.getComment();
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
};
</script>
