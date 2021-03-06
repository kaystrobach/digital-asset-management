import Icon from '@/components/Icon';
import {AjaxRoutes} from '@/enums/AjaxRoutes';
import {StorageInterface} from '@/interfaces/StorageInterface';
import {CreateElement, VNode} from 'vue';
import {Action} from 'vuex-class';
import {Component, Prop, Vue} from 'vue-property-decorator';

@Component
export default class TreeNode extends Vue {
    @Action(AjaxRoutes.damGetFolderItems)
    fetchData: any;

    @Prop()
    storage!: StorageInterface;

    constructor(props: any) {
        super(props);
    }

    get browsableIdentifier(): string {
        return this.storage.identifier + ':/';
    }

    private render(h: CreateElement): VNode {
        return(
            <span class='list-tree-group' data-identifier={this.browsableIdentifier}>
                <a href='#' data-identifier={this.browsableIdentifier} onclick={() => this.fetchData(this.browsableIdentifier)}>
                    <Icon identifier={this.storage.icon} /> {this.storage.storageName}
                </a>
            </span>
        );
    }
}
