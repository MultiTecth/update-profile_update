/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
/**
 * @module ui/panel/sticky/stickypanelview
 */
import View from '../../view';
import type ViewCollection from '../../viewcollection';
import { type Locale } from '@ckeditor/ckeditor5-utils';
import '../../../theme/components/panel/stickypanel.css';
/**
 * The sticky panel view class.
 */
export default class StickyPanelView extends View {
    /**
     * Collection of the child views which creates balloon panel contents.
     */
    readonly content: ViewCollection;
    /**
     * Controls whether the sticky panel should be active.
     *
     * @readonly
     * @observable
     */
    isActive: boolean;
    /**
     * Controls whether the sticky panel is in the "sticky" state.
     *
     * @readonly
     * @observable
     */
    isSticky: boolean;
    /**
     * The limiter element for the sticky panel instance. Its bounding rect limits
     * the "stickyness" of the panel, i.e. when the panel reaches the bottom
     * edge of the limiter, it becomes sticky to that edge and does not float
     * off the limiter. It is mandatory for the panel to work properly and once
     * set, it cannot be changed.
     *
     * @readonly
     * @observable
     */
    limiterElement: HTMLElement | null;
    /**
     * The offset from the bottom edge of {@link #limiterElement}
     * which stops the panel from stickying any further to prevent limiter's content
     * from being completely covered.
     *
     * @readonly
     * @observable
     * @default 50
     */
    limiterBottomOffset: number;
    /**
     * The offset from the top edge of the web browser's viewport which makes the
     * panel become sticky. The default value is `0`, which means the panel becomes
     * sticky when it's upper edge touches the top of the page viewport.
     *
     * This attribute is useful when the web page has UI elements positioned to the top
     * either using `position: fixed` or `position: sticky`, which would cover the
     * sticky panel or vice–versa (depending on the `z-index` hierarchy).
     *
     * Bound to {@link module:ui/editorui/editorui~EditorUI#viewportOffset `EditorUI#viewportOffset`}.
     *
     * If {@link module:core/editor/editorconfig~EditorConfig#ui `EditorConfig#ui.viewportOffset.top`} is defined, then
     * it will override the default value.
     *
     * @observable
     * @default 0
     */
    viewportTopOffset: number;
    /**
     * Controls the `margin-left` CSS style of the panel.
     *
     * @private
     * @readonly
     * @observable
     */
    _marginLeft: string | null;
    /**
     * Set `true` if the sticky panel reached the bottom edge of the
     * {@link #limiterElement}.
     *
     * @private
     * @readonly
     * @observable
     */
    _isStickyToTheLimiter: boolean;
    /**
     * Set `true` if the sticky panel uses the {@link #viewportTopOffset},
     * i.e. not {@link #_isStickyToTheLimiter} and the {@link #viewportTopOffset}
     * is not `0`.
     *
     * @private
     * @readonly
     * @observable
     */
    _hasViewportTopOffset: boolean;
    /**
     * The DOM bounding client rect of the {@link module:ui/view~View#element} of the panel.
     */
    private _panelRect?;
    /**
     * The DOM bounding client rect of the {@link #limiterElement}
     * of the panel.
     */
    private _limiterRect?;
    /**
     * A dummy element which visually fills the space as long as the
     * actual panel is sticky. It prevents flickering of the UI.
     */
    private _contentPanelPlaceholder;
    /**
     * The panel which accepts children into {@link #content} collection.
     * Also an element which is positioned when {@link #isSticky}.
     */
    private _contentPanel;
    /**
     * @inheritDoc
     */
    constructor(locale?: Locale);
    /**
     * @inheritDoc
     */
    render(): void;
    /**
     * Analyzes the environment to decide whether the panel should
     * be sticky or not.
     */
    private _checkIfShouldBeSticky;
}
