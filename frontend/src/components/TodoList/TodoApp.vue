<template>
  <v-container>
    <h1>MY-TODO</h1>

    <div>
      <v-icon @click.stop="drawer = !drawer">mdi-firebase</v-icon>
    </div>

    <v-navigation-drawer v-model="drawer" absolute bottom temporary>
      <v-list nav dense>
        <v-list-item-group active-class="deep-purple—text text—accent-4">
          <v-list-item>
            <v-list-item-title>
              <div class="text-center">
                <v-dialog v-model="dialog" width="500">
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn color="red lighten-2" dark v-bind="attrs" v-on="on">
                      20211124_Todo
                    </v-btn>
                  </template>

                  <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                      Privacy Policy
                    </v-card-title>

                    <v-card-text>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo consequat.
                      Duis aute irure dolor in reprehenderit in voluptate velit
                      esse cillum dolore eu fugiat nulla pariatur. Excepteur
                      sint occaecat cupidatat non proident, sunt in culpa qui
                      officia deserunt mollit anim id est laborum.
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="primary" text @click="onClick">
                        I accept
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </div>
            </v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <div id="todo-app">
      <todo-input />
      <todo-list />
      <todo-clear />
      <v-btn @click="onClickReturn">돌아가기</v-btn>
    </div>
  </v-container>
</template>

<script>
import TodoInput from "./TodoInput";
import TodoList from "./TodoList";
import TodoClear from "./TodoClear";
import axios from "axios";

export default {
  name: "todo-app",
  data: () => ({
    drawer: false,
    group: null,
    dialog: false,
  }),

  watch: {
    group() {
      this.drawer = false;
    },
  },
  components: {
    TodoInput,
    TodoList,
    TodoClear,
  },
  methods: {
    onClickReturn() {
      this.$router.push({ path: "/" });
      location.reload();
    },
    onClick() {
      this.dialog = false;

      const form = new FormData();
      form.append("user_id", this.$store.state.auth.user.user.id);
      axios
        .post("/api/todo", form)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
#todo-app {
  margin: 0 0.5rem;
  position: relative;
}
h1 {
  color: #484848;
  text-align: center;
  padding-top: 2.5rem;
}
body {
  margin: 0;
}
div {
  box-sizing: border-box;
}
.black-bg {
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
  padding: 20px;
}
.white-bg {
  width: 100%;
  background: white;
  border-radius: 8px;
  padding: 20px;
}
</style>
