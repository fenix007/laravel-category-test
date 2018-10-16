export default class ListToTree {
    toTree(list) {
        let map = {}, node, roots = [], i;
        for (i = 0; i < list.length; i += 1) {
            map[list[i].id] = i; // initialize the map
            list[i].element = 'category=' + list[i].id;
        }
        for (i = 0; i < list.length; i += 1) {
            node = list[i];
            if (node.parent_id !== null) {
                // if you have dangling branches check that map[node.parentId] exists
                if (!list[map[node.parent_id]].children) {
                    list[map[node.parent_id]].children = [];
                }
                list[map[node.parent_id]].children.push(node);
            } else {
                roots.push(node);
            }
        }
        return roots;
    }
}
