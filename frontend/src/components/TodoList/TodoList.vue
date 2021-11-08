<template>
  <div>
    <ul>
      <li
        v-for="(v, index) in todoList"
        :key="v.todo"
        @click="doneToggle({ todo: v.todo, index: index })"
        :class="checked(v.done)"
      >
        <span class="todo-list">{{ v.todo }}</span>
        <span
          class="delete-todo"
          @click.stop="deleteTodo({ todo: v.todo, index: index })"
        >
          x
        </span>
      </li>
    </ul>
  </div>
</template>

<script>
import Constant from "../../store/modules/constant";
// import _ from 'lodash'
export default {
  name: "todo-list",
  computed: {
    todoList() {
      return this.$store.state.todoList;
    },
  },
  methods: {
    checked(done) {
      return done ? { checked: true } : { checked: false };
    },
    doneToggle(val) {
      this.$store.commit(Constant.DONE_TOGGLE, {
        todo: val.todo,
        index: val.index,
      });
    },
    deleteTodo(val) {
      this.$store.commit(Constant.DELETE_TODO, {
        todo: val.todo,
        index: val.index,
      });
    },
  },
  created() {
    this.$store.commit(Constant.SHOW_LIST);
  },
};
</script>

<style scoped>
ul li {
  height: 3rem;
  border-radius: 5px;
  box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.03);
  background-color: #fff;
  margin: 0.5rem 0;
  display: flex;
  align-items: center;
  padding-left: 1rem;
  color: #404040;
  position: relative;
  font-size: 1rem;
  cursor: pointer;
  transition: 0.4s;
}
ul li:hover {
  background-color: rgba(255, 255, 255, 0.7);
  animation: scale 0.5s forwards ease-in-out;
}
ul li.checked {
  text-decoration: line-through;
  background-color: rgba(255, 255, 255, 0.3);
  animation: scale 0.5s forwards ease-in-out;
}
@keyframes scale {
  50% {
    transform: scale(0.95);
  }
  100% {
    transform: scale(1);
  }
}
.delete-todo {
  color: #de4343;
  font-weight: 900;
  font-size: 1.2rem;
  position: absolute;
  right: 1rem;
}
</style>
