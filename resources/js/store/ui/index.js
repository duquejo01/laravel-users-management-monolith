import { defineStore } from 'pinia';

const STORE_NAME = 'ui';
const STORE_LOCAL_STORAGE_KEY = 'ui_settings';

const getDefaultSettings = () => ({
  isSidebarOpen: false,
  darkMode: false,
});

const getSettings = () => {
  const settings = localStorage.getItem(STORE_LOCAL_STORAGE_KEY);
  return settings ? JSON.parse(settings) : getDefaultSettings();
};

export const useUIStore = defineStore( STORE_NAME, {
  state: () => ({
    settings: getSettings(),
  }),
  getters: {
    getSidebarStatus: (state) => state.settings.isSidebarOpen,
    getDarkModeStatus: (state) => state.settings.darkMode,
  },
  actions: {
    toggleSidebar() {
      this.settings = {
        ...this.settings,
        isSidebarOpen: ! this.settings.isSidebarOpen,
      };
      localStorage.setItem(STORE_LOCAL_STORAGE_KEY, JSON.stringify(this.settings));
    },
    toggleDarkMode() {
      this.settings = {
        ...this.settings,
        darkMode: ! this.settings.darkMode,
      };

      if( this.settings.darkMode === true ) {
          document.documentElement.classList.add('dark');
      } else {
          document.documentElement.classList.remove('dark');
      }
      localStorage.setItem(STORE_LOCAL_STORAGE_KEY, JSON.stringify(this.settings));
    }
  },
});