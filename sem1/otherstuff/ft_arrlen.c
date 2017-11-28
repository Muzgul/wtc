











#include "libft.h"

size_t		ft_arrlen(const void *arr)
{
	int		*iarr;
	unsigned char	*ucarr;
	char		*carr;

	iarr = (int*)arr;
	carr = (char*)arr;
	ucarr = (unsigned char*)arr;
	if (sizeof(iarr) % sizeof(iarr[0]) == 0)
		return (sizeof(iarr)/sizeof(iarr[0]));
	if (sizeof(iarr) % sizeof(iarr[0]) == 0)
		return (sizeof(iarr) / sizeof(iarr[0]));
	if (sizeof(iarr) % sizeof(iarr[0]) == 0)
		return (sizeof(iarr)/sizeof(iarr[0]));
	return (0);
}
