// store/modules/myModule.ts
import { Module } from 'vuex';
import { CancelTokenSource } from 'axios';

export interface IMessage {
  text: string;
  type: 'success' | 'error' | 'info';
}

export interface IState<T> {
  data: T[];
  loading: boolean;
  error: boolean;
  message: IMessage[];
  errorMessage: IMessage[];
  cancelToken: CancelTokenSource | undefined;
  status: string | undefined;
}

export const initialState = <T>(): IState<T> => ({
  data: [],
  loading: false,
  error: false,
  message: [],
  errorMessage: [],
  cancelToken: undefined,
  status: undefined
});

// Ejemplo con un tipo concreto, por ejemplo: Item
export interface Item {
  id: number;
  name: string;
}

export const myModule: Module<IState<Item>, unknown> = {
  namespaced: true,
  state: () => initialState<Item>(),
  mutations: {
    setData(state, payload: Item[]) {
      state.data = payload;
    },
    setLoading(state, payload: boolean) {
      state.loading = payload;
    },
    setError(state, payload: boolean) {
      state.error = payload;
    },
    setMessage(state, payload: IMessage[]) {
      state.message = payload;
    },
    setErrorMessage(state, payload: IMessage[]) {
      state.errorMessage = payload;
    },
    setCancelToken(state, payload: CancelTokenSource) {
      state.cancelToken = payload;
    },
    setStatus(state, payload: string) {
      state.status = payload;
    },
    resetState(state) {
      Object.assign(state, initialState<Item>());
    }
  },
  actions: {
    async fetchData({ commit }) {
      commit('setLoading', true);
      try {
        // Lógica de fetch
        const data: Item[] = []; // ejemplo
        commit('setData', data);
      } catch (e) {
        commit('setError', true);
      } finally {
        commit('setLoading', false);
      }
    }
  },
  getters: {
    isLoading: state => state.loading,
    hasError: state => state.error,
    allData: state => state.data
  }
};
