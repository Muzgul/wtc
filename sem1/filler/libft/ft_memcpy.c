/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memcpy.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/07 15:14:23 by mmacdona          #+#    #+#             */
/*   Updated: 2017/10/01 02:08:32 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	*ft_memcpy(void *restrict dst, const void *restrict src, size_t n)
{
	size_t				i;
	unsigned char		*pd;
	const unsigned char	*ps;

	i = 0;
	pd = (unsigned char*)dst;
	ps = (const unsigned char*)src;
	while (i < n)
	{
		*(pd + i) = *(ps + i);
		i++;
	}
	return (dst);
}
