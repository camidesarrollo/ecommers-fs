// src/store/devtools.ts
import { PiniaPluginContext } from "pinia";

// Plugin para habilitar devtools solo en desarrollo
export function devtoolsPlugin(context: PiniaPluginContext) {
  if (process.env.NODE_ENV !== "production") {
    console.log(`[Pinia DevTools] Store ${context.store.$id} initialized`);
  }
}

// Función para crear un "enhancer" similar a Redux compose
export const composeEnhancers =
  process.env.NODE_ENV !== "production"
    ? (plugin: (ctx: PiniaPluginContext) => void) => plugin
    : (plugin: (ctx: PiniaPluginContext) => void) => () => {};
