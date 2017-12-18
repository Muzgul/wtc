#include "lem_in.h"
#include "libft/libft.h"
#include <sys/types.h>
#include <sys/uio.h>
#include <unistd.h>
#include <fcntl.h>
#include <stdio.h>

int     main()
{
	int     fd;
	char    *line = NULL;

	fd = open("some.txt", O_RDONLY);
	if (fd == -1)
	{
		ft_putstr("open() error");
		return (1);
	}
	printf("Lem_in: %i\n", lem_in((int const)fd, &line));
	return (1);
}
