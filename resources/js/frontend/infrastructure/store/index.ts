// store/modules/index.ts
import { storeModule } from './store.module'; // ajusta la ruta según tu estructura
import { Module } from 'vuex';
import { State as MyModuleState } from './store.module';

export interface RootState {
  myModule: MyModuleState;
}

export const modules: { [key: string]: Module<any, RootState> } = {
  myModule: storeModule,
};
