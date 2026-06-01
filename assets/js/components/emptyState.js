const EmptyStateComponent = {
    row({ colspan = 3, icon = "search", title = "Nenhum registro", text = "Dados serão carregados pelo back-end." }) {
        return `
            <tr class="empty-row">
                <td colspan="${colspan}">
                    <div class="empty-state-card">
                        <span class="empty-state-icon icon-orange">${SageIcons[icon] || SageIcons.search}</span>
                        <strong>${title}</strong>
                        <small>${text}</small>
                    </div>
                </td>
            </tr>
        `;
    }
};
