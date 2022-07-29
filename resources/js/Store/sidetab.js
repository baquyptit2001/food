export const sidetab = {
    state: () => ({
        isCollapsed: false,
    }),

    mutations: {
        toggleSidebar(state) {
            state.isCollapsed = !state.isCollapsed
        }
    },

    actions: {
        toggleSidebar({commit}) {
            commit('toggleSidebar')
        }
    },

    getters: {
        isCollapsed(state) {
            return state.isCollapsed
        }
    }
}

