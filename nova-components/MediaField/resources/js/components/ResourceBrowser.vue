<template>

    <transition name="fade">
        <modal v-if="open" @modal-close="$emit('onClose')" >
            <div :class="modal.class" :style="modal.style">
                <loading-view :loading="initialLoading" :dusk="resourceName + '-index-component'">

                    <heading v-if="resourceResponse" class="mb-3">{{ headingTitle }}</heading>

                    <div class="flex">
                        <!-- Select -->
                        <input type="button" value="Select" @click="this.select" :disabled="!this.selectedResources.length" dusk="select-button"
                            :class="'ml-auto btn btn-default btn-primary mb-6 ' + (!this.selectedResources.length ? ' opacity-50 cursor-not-allowed':'')"
                        />


                        <div class="w-full flex items-center mb-6">
                            <custom-index-toolbar v-if="!viaResource" :resource-name="resourceName" />

                            <!-- Search -->
                            <div
                                v-if="resourceInformation.searchable && !viaHasOne"
                                class="relative h-9 mr-4 flex-no-shrink"
                            >
                                <icon type="search" class="absolute search-icon-center ml-3 text-70" />

                                <input
                                    data-testid="search-input"
                                    dusk="search"
                                    class="appearance-none form-control form-input w-search pl-search"
                                    :placeholder="__('Search')"
                                    type="search"
                                    v-model="search"
                                    @keydown.stop="performSearch"
                                    @search="performSearch"
                                />
                            </div>

                            <!-- Create / Attach Button -->
                            <create-resource-button
                                :singular-name="singularName"
                                :resource-name="resourceName"
                                :via-resource="viaResource"
                                :via-resource-id="viaResourceId"
                                :via-relationship="viaRelationship"
                                :relationship-type="relationshipType"
                                :authorized-to-create="authorizedToCreate && !resourceIsFull"
                                :authorized-to-relate="authorizedToRelate"
                                class="flex-no-shrink ml-auto"
                            />
                        </div>
                    </div>

                    <card>
                        <div class="py-3 flex items-center border-b border-50">
                            <div class="flex items-center">
                                <div class="px-3" v-if="shouldShowCheckBoxes">
                                    <!-- Select All -->
                                    <dropdown dusk="select-all-dropdown">
                                        <dropdown-trigger slot-scope="{ toggle }" :handle-click="toggle">
                                            <fake-checkbox :checked="selectAllChecked" />
                                        </dropdown-trigger>

                                        <dropdown-menu slot="menu" direction="ltr" width="250">
                                            <div class="p-4">
                                                <ul class="list-reset">
                                                    <li class="flex items-center mb-4">
                                                        <checkbox-with-label
                                                            :checked="selectAllChecked"
                                                            @change="toggleSelectAll"
                                                        >
                                                            {{ __('Select All') }}
                                                        </checkbox-with-label>
                                                    </li>
                                                    <li class="flex items-center">
                                                        <checkbox-with-label
                                                            dusk="select-all-matching-button"
                                                            :checked="selectAllMatchingChecked"
                                                            @change="toggleSelectAllMatching"
                                                        >
                                                            <template>
                                                                <span class="mr-1">
                                                                    {{__('Select All Matching') }} ({{
                                                                        allMatchingResourceCount
                                                                    }})
                                                                </span>
                                                            </template>
                                                        </checkbox-with-label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </dropdown-menu>
                                    </dropdown>
                                </div>
                            </div>

                            <div class="flex items-center ml-auto px-3">
                                <!-- Action Selector -->
                                <action-selector
                                    v-if="selectedResources.length > 0"
                                    :resource-name="resourceName"
                                    :actions="actions"
                                    :pivot-actions="pivotActions"
                                    :pivot-name="pivotName"
                                    :query-string="{
                                        currentSearch,
                                        encodedFilters,
                                        currentTrashed,
                                        viaResource,
                                        viaResourceId,
                                        viaRelationship,
                                    }"
                                    :selected-resources="selectedResourcesForActionSelector"
                                    @actionExecuted="getResources"
                                />

                                <!-- Filters -->
                                <filter-menu
                                    :resource-name="resourceName"
                                    :soft-deletes="softDeletes"
                                    :via-resource="viaResource"
                                    :via-has-one="viaHasOne"
                                    :trashed="trashed"
                                    :per-page="perPage"
                                    :per-page-options="perPageOptions"
                                    @clear-selected-filters="clearSelectedFilters"
                                    @filter-changed="filterChanged"
                                    @trashed-changed="trashedChanged"
                                    @per-page-changed="updatePerPageChanged"
                                />

                                <delete-menu
                                    v-if="shouldShowDeleteMenu"
                                    dusk="delete-menu"
                                    :soft-deletes="softDeletes"
                                    :resources="resources"
                                    :selected-resources="selectedResources"
                                    :via-many-to-many="viaManyToMany"
                                    :all-matching-resource-count="allMatchingResourceCount"
                                    :all-matching-selected="selectAllMatchingChecked"
                                    :authorized-to-delete-selected-resources="
                                        authorizedToDeleteSelectedResources
                                    "
                                    :authorized-to-force-delete-selected-resources="
                                        authorizedToForceDeleteSelectedResources
                                    "
                                    :authorized-to-delete-any-resources="authorizedToDeleteAnyResources"
                                    :authorized-to-force-delete-any-resources="
                                        authorizedToForceDeleteAnyResources
                                    "
                                    :authorized-to-restore-selected-resources="
                                        authorizedToRestoreSelectedResources
                                    "
                                    :authorized-to-restore-any-resources="authorizedToRestoreAnyResources"
                                    @deleteSelected="deleteSelectedResources"
                                    @deleteAllMatching="deleteAllMatchingResources"
                                    @forceDeleteSelected="forceDeleteSelectedResources"
                                    @forceDeleteAllMatching="forceDeleteAllMatchingResources"
                                    @restoreSelected="restoreSelectedResources"
                                    @restoreAllMatching="restoreAllMatchingResources"
                                    @close="deleteModalOpen = false"
                                />
                            </div>
                        </div>

                        <loading-view :loading="loading">
                            <div v-if="!resources.length" class="flex justify-center items-center px-6 py-8">
                                <div class="text-center">
                                    <svg
                                        class="mb-3"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="65"
                                        height="51"
                                        viewBox="0 0 65 51"
                                    >
                                        <g id="Page-1" fill="none" fill-rule="evenodd">
                                            <g
                                                id="05-blank-state"
                                                fill="#A8B9C5"
                                                fill-rule="nonzero"
                                                transform="translate(-779 -695)"
                                            >
                                                <path
                                                    id="Combined-Shape"
                                                    d="M835 735h2c.552285 0 1 .447715 1 1s-.447715 1-1 1h-2v2c0 .552285-.447715 1-1 1s-1-.447715-1-1v-2h-2c-.552285 0-1-.447715-1-1s.447715-1 1-1h2v-2c0-.552285.447715-1 1-1s1 .447715 1 1v2zm-5.364125-8H817v8h7.049375c.350333-3.528515 2.534789-6.517471 5.5865-8zm-5.5865 10H785c-3.313708 0-6-2.686292-6-6v-30c0-3.313708 2.686292-6 6-6h44c3.313708 0 6 2.686292 6 6v25.049375c5.053323.501725 9 4.765277 9 9.950625 0 5.522847-4.477153 10-10 10-5.185348 0-9.4489-3.946677-9.950625-9zM799 725h16v-8h-16v8zm0 2v8h16v-8h-16zm34-2v-8h-16v8h16zm-52 0h16v-8h-16v8zm0 2v4c0 2.209139 1.790861 4 4 4h12v-8h-16zm18-12h16v-8h-16v8zm34 0v-8h-16v8h16zm-52 0h16v-8h-16v8zm52-10v-4c0-2.209139-1.790861-4-4-4h-44c-2.209139 0-4 1.790861-4 4v4h52zm1 39c4.418278 0 8-3.581722 8-8s-3.581722-8-8-8-8 3.581722-8 8 3.581722 8 8 8z"
                                                />
                                            </g>
                                        </g>
                                    </svg>

                                    <h3 class="text-base text-80 font-normal mb-6">
                                        {{
                                            __('No :resource matched the given criteria.', {
                                                resource: singularName.toLowerCase(),
                                            })
                                        }}
                                    </h3>

                                    <create-resource-button
                                        classes="btn btn-sm btn-outline inline-flex items-center"
                                        :singular-name="singularName"
                                        :resource-name="resourceName"
                                        :via-resource="viaResource"
                                        :via-resource-id="viaResourceId"
                                        :via-relationship="viaRelationship"
                                        :relationship-type="relationshipType"
                                        :authorized-to-create="authorizedToCreate && !resourceIsFull"
                                        :authorized-to-relate="authorizedToRelate"
                                    >
                                    </create-resource-button>
                                </div>
                            </div>

                            <div class="overflow-hidden overflow-x-auto relative">
                                <!-- Resource Table -->
                                <resource-table
                                    :authorized-to-relate="authorizedToRelate"
                                    :resource-name="resourceName"
                                    :resources="resources"
                                    :singular-name="singularName"
                                    :selected-resources="selectedResources"
                                    :selected-resource-ids="selectedResourceIds"
                                    :actions-are-available="allActions.length > 0"
                                    :should-show-checkboxes="shouldShowCheckBoxes"
                                    :via-resource="viaResource"
                                    :via-resource-id="viaResourceId"
                                    :via-relationship="viaRelationship"
                                    :relationship-type="relationshipType"
                                    :update-selection-status="updateSelectionStatus"
                                    @order="orderByField"
                                    @delete="deleteResources"
                                    @restore="restoreResources"
                                    ref="resourceTable"
                                />
                            </div>

                            <!-- Pagination -->
                            <component
                                :is="paginationComponent"
                                v-if="resourceResponse && resources.length > 0"
                                :next="hasNextPage"
                                :previous="hasPreviousPage"
                                @page="selectPage"
                                :pages="totalPages"
                                :page="currentPage"
                            >
                                <span
                                    v-if="resourceCountLabel"
                                    class="text-sm text-80 px-4"
                                    :class="{ 'ml-auto': paginationComponent == 'pagination-links' }"
                                >
                                    {{ resourceCountLabel }}
                                </span>
                            </component>
                        </loading-view>
                    </card>
                </loading-view>
            </div>

            <transition name="fade">
                <modal v-if="modal.show" @modal-close="closeModal">
                    <div :class="modal.class" :style="modal.style">
                        <resource-create v-if="browseRoute=='create'" v-bind="browseProps"></resource-create>
                        <resource-detail v-if="browseRoute=='detail'" v-bind="browseProps"></resource-detail>
                        <resource-update v-if="browseRoute=='edit'" v-bind="browseProps"></resource-update>
                    </div>
                </modal>
            </transition>
        </modal>
    </transition>

</template>

<script>
import Vue from 'vue';
import VueRouter from 'vue-router';
import ResourceIndex from '../../../../../nova/resources/js/views/Index';
import ResourceCreate from '../../../../../nova/resources/js/views/Create';
import ResourceDetail from '../../../../../nova/resources/js/views/Detail';
import ResourceUpdate from '../../../../../nova/resources/js/views/Update';
/*
var previousRoute;

Nova.booting((Vue, router) => {
    previousRoute = Vue.$route;
    router.afterEach((to, from)=>{
        previousRoute = from;
    })
});
*/
export default {
    mixins: [ResourceIndex],
    components: {ResourceCreate, ResourceDetail, ResourceUpdate},
    props: ['open'],
    data(){
        return {
            browseRoute: null,
            browseProps: null,
        }
    },
    created(){
        this.unregisterGuard = this.$router.beforeEach((to, from, next)=>{

            if(!this.open){
                return next();
            }

            //if search, filter, pagination request
            if(to.path===from.path){
                return next();
            }

            if(this.modal.routes.includes(to.name)){
                this.browseRoute = to.name;
                this.browseProps = {...to.params, ...to.query};
                if(this.browseProps.resourceId){
                    this.browseProps.resourceId = this.browseProps.resourceId.toString();
                }
                console.log(this.browseProps)
            }
            else {
                //may be cancel button clicked
                this.closeModal();
            }
            Nova.app.$loading.finish();
            return next(false);
        })
    },
    destroyed(){
        console.log('destroyed', this.unregisterGuard);
        this.unregisterGuard();
    },
    beforeUpdate(){
        console.log('before update', this.open)
    },
    computed: {
        modal() {
            const routes = ['create','detail','edit'];
            var show = this.open && routes.includes(this.browseRoute);
            return {
                routes,
                show,
                class: 'bg-40 rounded shadow-lg overflow-hidden p-4',
                style: 'width: 1024px; min-width: 1024px;',
            }
        },
        headingTitle(){
            return 'Browse ' + ResourceIndex.computed.headingTitle.bind(this)();
        }
    },
    methods: {
        async closeModal(){
            this.browseRoute = null;
            await this.getResources();
        },
        select() {
            this.$emit('select', this.selectedResources.map(res => {
                return Object.values(res.fields).reduce((res, field) => {
                    res[field.attribute] = field.value;
                    return res;
                }, {id: res.id.value });
            } ));
        }
    }
}
</script>
