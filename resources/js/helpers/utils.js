// has permission
export const hasPermissionTo = (permission, permissions = []) => {
    return permissions.includes(permission);
};
