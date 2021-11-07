<template>
  <div>
    <input
      type="text"
      v-model.trim="todo"
      placeholder="할 일을 입력하세요."
      class="todo-input"
      @keyup.enter="addTodo"
      maxlength="30"
    />
    <button type="button" class="add-todo-btn" @click="addTodo">
      +
    </button>
  </div>
</template>

<script>
import Constant from "../constant";
export default {
  name: "todo-input",
  data() {
    return {
      todo: "",
    };
  },
  methods: {
    addTodo() {
      this.$store.commit(Constant.ADD_TODO, { todo: this.todo });
      this.todo = "";
    },
  },
};
</script>

<style scoped>
.todo-input {
  display: block;
  width: 100%;
  height: 3rem;
  border-radius: 5px;
  margin: 0.8rem 0;
  box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.03);
  display: flex;
  align-items: center;
  font-size: 0.9rem;
  padding-left: 1rem;
}
.todo-input:first-of-type {
  margin-top: 2rem;
}
.add-todo-btn {
  width: 3rem;
  height: 3rem;
  border-radius: 0 5px 5px 0;
  background: linear-gradient(to right, #6478fb, #8763fb);
  position: absolute;
  right: 0;
  margin-top: -3.8rem;
  color: #fff;
  font-size: 1.2rem;
  font-weight: 800;
  cursor: pointer;
}
</style>
