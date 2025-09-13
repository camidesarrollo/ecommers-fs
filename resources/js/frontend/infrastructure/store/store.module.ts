import { ActionContext, Module } from '../../../../../node_modules/vuex/types/index';

export interface State {
  status: boolean;
}

export const storeModule: Module<State, unknown> = {
  namespaced: true,
  state: (): State => ({
    status: true,
  }),
  mutations: {
    setAllowed(state: State, payload: boolean) {
      state.status = payload;
    },
  },
  actions: {
    allowed({ commit }: ActionContext<State, unknown>) {
      commit('setAllowed', true);
    },
  },
  getters: {
    isAllowed: (state: State) => state.status,
  },
};
