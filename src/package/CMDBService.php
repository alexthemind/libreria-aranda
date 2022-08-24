<?php

namespace Aranda\Lib\Package;

class CMDBService {

    public const OWNED_RESOURCE = "nr";
    public const FAMILY = "nrf";
    public const ITEM_CLASS = "grc";
    public const MODEL = "mfrmod";
    public const COMPANY = "ca_cmpny";
    public const GROUPS = "grp";
    public const GROUP_MEMBER = "grpmem";
    public const TENANT = "tenant";
    public const CATEGORIES = "chgcat";
    public const CONTACT = "cnt";
    public const ORGANIZATION = "org";

    private const USERNAME = 'RFCIntegration@sndintca.cl';
    private const PASSWORD = 'RFCIntegration';

    private const ATTR_NAME = 'AttrName';
    private const ATTR_VAL = 'AttrValue';

    private const LIST_HANDLE = 'listHandle';
    private const LIST_LENGTH = 'listLength';

}