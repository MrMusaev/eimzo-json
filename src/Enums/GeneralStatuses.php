<?php

namespace MrMusaev\EImzo\Enums;

enum GeneralStatuses: int
{
    case SUCCESSFUL = 1;

    case UNSUCCESSFUL_CHECK_LOGS = -1;
}
